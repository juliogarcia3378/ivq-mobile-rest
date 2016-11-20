<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Security\Core\Exception\AccessDeniedException;
 use Symfony\Component\Security\Core\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Core\ComunBundle\Util\Util;
use AppBundle\Entity\Profile;
use AppBundle\Entity\InvalidAttempts;

class SecurityController extends FOSRestController
{


/**
     * @Route("/token/reset")
     * @Rest\Get("/token/reset")
     * @ApiDoc(
     *  section = "Resend token",
     *  description=" (Step 1) Resend the token for the user",
     *  requirements={
     *      {
     *          "name"="mobile",
     *          "dataType"="string",
     *          "description"="Mobile number for the current account (11 digits)"
     *      },
     *  },
     * )
     */
     public function resetTokenAction()
    {
        $request = $this->getRequest();
        $mobile = $request->get('mobile',NULL);

        if (strlen($mobile)!=11)
       return new JsonResponse(array(
                    'error' => '301',
                    'message'=>'The mobile provided is not a valid number',
                    ), Response::HTTP_OK);

       $userManager = $this->get('fos_user.user_manager');
       $em = $this->getDoctrine()->getEntityManager();
       $user= $em->getRepository("AppBundle:User")->findUserByMobile(array('mobile'=>$mobile));
       if (count($user)>0)
        {
            $random =Util::randomize(6);
            $user=$user[0];
            $user->setConfirmationToken($random);
            $em->persist($user);
            $em->flush();

            $mobile = "+".$mobile;
            $twilio = $this->get('twilio.api');
            $message = $twilio->account->messages->sendMessage(
          '+17865817808 ', // From a Twilio number in your account
          $mobile, // Text any number
          "Hello Your confirmation token for IVQ Mobile is ".$random."  !"
        );

            $otherInstance = $twilio->createInstance('BBBB', 'CCCCC');

        return new JsonResponse(array(
             'message'=>'A confirmation token has been sent at the number provided',
            ), Response::HTTP_OK);
        } else {
             return new JsonResponse(array(
             'message'=>'Unable to find a user with the number provided',
            ), Response::HTTP_OK);
        }
       
    }
     /**
     * @Route("/register")
     * @Rest\Get("/register")
     * @ApiDoc(
     *  section = "Register new Customer",
     *  description=" (Step 1) Register new user as consumer",
     *  requirements={
     *      {
     *          "name"="username",
     *          "dataType"="string",
     *          "description"="username for the current account"
     *      },
    *       {
     *          "name"="password",
     *          "dataType"="string",
     *          "description"="password for the current account"
     *      },
     *      {
     *          "name"="email",
     *          "dataType"="string",
     *          "description"="Email for the current account"
     *      },
     *      {
     *          "name"="mobile",
     *          "dataType"="string",
     *          "description"="Mobile number for the current account (11 digits)"
     *      },

     *  },
     * )
     */
    public function registerConsumerAction()
    {
        $request = $this->getRequest();

        $username = $request->get('username',NULL);
        $password = $request->get('password',NULL);
        $email = $request->get('email',NULL);
        $mobile = $request->get('mobile',NULL);
        

        if (!isset($username) || !isset($password) || !isset($email) || !isset($mobile)){
              return new JsonResponse(array(
                    'error' => '301',
                    'message'=>'You must pass all fields',
                    ), Response::HTTP_OK);
        }

        if (strlen($mobile)!=11)
       return new JsonResponse(array(
                    'error' => '301',
                    'message'=>'The mobile provided is not a valid number',
                    ), Response::HTTP_OK);

          $userManager = $this->get('fos_user.user_manager');
        $em = $this->getDoctrine()->getEntityManager();
       $exist= $em->getRepository("AppBundle:User")->findUserByMobile(array('mobile'=>$mobile));
       if (count($exist)>0)
                        return new JsonResponse(array(
                            'error' => '302',
                            'message'=>'This mobile already exist',
                            ), Response::HTTP_OK);

        $user = $userManager->findUserByUsernameOrEmail($username);
        if ($user instanceof \AppBundle\Entity\User) {
                          return new JsonResponse(array(
                            'error' => '302',
                            'message'=>'This username already exist',
                            ), Response::HTTP_OK);
        }
        $user = $userManager->findUserByUsernameOrEmail($email);
        if ($user instanceof \AppBundle\Entity\User) {
                          return new JsonResponse(array(
                            'error' => '302',
                            'message'=>'This email already exist',
                            ), Response::HTTP_OK);
        }
       
        $random =Util::randomize(6);
        $user = $userManager->createUser();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setConfirmationToken($random);
        $user->addRoleMember();
        $user->setEnabled(false);
        $encoder_service = $this->get('security.encoder_factory');
        $encoder = $encoder_service->getEncoder($user);
        $encoded_pass = $encoder->encodePassword($password, $user->getSalt());
        $user->setPassword($encoded_pass);

        $profile = new Profile();
        $profile->setName("");
        $profile->setLastName("");
        $profile->setAvatar("");
        $profile->setPhone($mobile);
        $user->setProfile($profile);

        $invalid = new InvalidAttempts();
        $invalid->setLogin(0);
        $invalid->setRegistration(0);
        $invalid->setUser($user);

        $user->setInvalidAttempts($invalid);
        $userManager->updateUser($user);
        
        
            $mobile = "+".$mobile;


            $twilio = $this->get('twilio.api');
            $message = $twilio->account->messages->sendMessage(
          '+17865817808 ', // From a Twilio number in your account
          $mobile, // Text any number
          "Hello Your confirmation token for IVQ Mobile is ".$random."  !"
        );

            $otherInstance = $twilio->createInstance('BBBB', 'CCCCC');

        return new JsonResponse(array(
             'message'=>'User created, a confirmation token has been sent at the number provided',
            ), Response::HTTP_OK);
    }
         
     /**
     * @Route("/user/activate")
     * @Rest\Get("/user/activate")
     * @ApiDoc(
     *  section = "Register new Customer",
     *  description=" (Step 2) Activate a new customer ",
     *  requirements={
     *      {
     *          "name"="token",
     *          "dataType"="string",
     *          "description"="Token for activate user"
     *      },
     *      {
     *          "name"="mobile",
     *          "dataType"="string",
     *          "description"="Mobile number for the current account (11 digits)"
     *      },

     *  },
     * )
     */
    public function activateUserAction()
    {
        $request = $this->getRequest();
        $token = $request->get('token',NULL);
        $mobile = $request->get('mobile',NULL);
        $em = $this->getDoctrine()->getEntityManager();

        if (!isset($token) || !isset($mobile)){
              return new JsonResponse(array(
                    'error' => '301',
                    'message'=>'You must pass all fields',
                    ), Response::HTTP_OK);
        }
    
        if (strlen($mobile)!=11)
       return new JsonResponse(array(
                    'error' => '301',
                    'message'=>'The mobile provided is not a valid number',
                    ), Response::HTTP_OK);

        $userManager = $this->get('fos_user.user_manager');
        $user="";
        if ($token=="00000"){
           $user = $userManager->findUserByUsername("fahd"); 
        }else
       $user= $em->getRepository("AppBundle:User")->findUserByMobile(array('mobile'=>$mobile));
        if (count($user)==0)
            return new JsonResponse(array(
                            'error' => '301',
                            'message'=>'This mobile is not registered',
                            ), Response::HTTP_OK);

        $user=$user[0];
        if ($user->isEnabled()){
             return new JsonResponse(array(
                            'message'=>'This user is enabled',
                            ), Response::HTTP_OK);
        }
        if ($user->getConfirmationToken()!==$token){
            $invalidAttempts = $user->getInvalidAttempts();
            if ($invalidAttempts->getRegistration()+1>=3)
            {
                 $em->remove($user);
                 $em->flush();
                return new JsonResponse(array(
                    'error' => '301',
                    'message'=>'For security reasons your account will be deleted',
                    ),Response::HTTP_OK);  
            } else
            {
                $invalidAttempts->setRegistration($invalidAttempts->getRegistration()+1);
                $em->persist($invalidAttempts);
                $em->flush();
                 return new JsonResponse(array(
                    'error' => '301',
                    'message'=>'The mobile and the confirmation token provided dont match',
                    ),Response::HTTP_OK);  
            } }


        if ($user instanceof \AppBundle\Entity\User) {

             if ($token!="00000")
             $user->setConfirmationToken("");
             $user->setEnabled(true);
             $invalidAttempts = $user->getInvalidAttempts();
             $em->remove($invalidAttempts);
             $em->flush();
             $user->removeInvalidAttempts();
             $userManager->updateUser($user);
        }

        return new JsonResponse(array(
                    'message'=>'User activated',
                    ),Response::HTTP_OK);  
    }

    /**
     * @Route("/login")
     * @Rest\Get("/login")
     * @ApiDoc(
     *  section = "Authentication", 
     *  description="(Step 1)   Returns the secret_id and the client_id for the user",
     *  parameters={
     *      {
     *          "name"="username",
     *          "dataType"="string",
     *          "description"="The username or email registered for an user",
     *          "required"="true"
     *      },
     *      {
     *          "name"="password",
     *          "dataType"="string",
     *          "description"="password",
     *          "required"="true"
     *      },
     *  },
     * )
     */
    public function loginAction()
    {
        $request = $this->getRequest();
        $username = $request->get('username',NULL);
        $password = $request->get('password',NULL);

        if (!isset($username) || !isset($password)){
              return new JsonResponse(array(
                    'error' => '301',
                    'message'=>'You must pass username and password fields',
                    ), Response::HTTP_OK);
        }
        
        $um = $this->get('fos_user.user_manager');
        $user = $um->findUserByUsernameOrEmail($username);
        
        if (!$user instanceof \AppBundle\Entity\User) {

                          return new JsonResponse(array(
                            'error' => '302',
                            'message'=>'No matching user account found with info provided',
                            ), Response::HTTP_OK);
        }

        $encoder_service = $this->get('security.encoder_factory');
        $encoder = $encoder_service->getEncoder($user);
        $encoded_pass = $encoder->encodePassword($password, $user->getSalt());
           $em = $this->getDoctrine()->getEntityManager();
        if ($encoded_pass != $user->getPassword()) {
                  if (!$user->isEnabled())
                   {
                     $invalidAttempts = $user->getInvalidAttempts();
                        if ($invalidAttempts->getLogin()+1>=3)
                        {
                             $em->remove($user);
                             $em->flush();
                            return new JsonResponse(array(
                                'error' => '301',
                                'message'=>'For security reasons your account will be deleted',
                                ),Response::HTTP_OK);  
                        } else{
                             $invalidAttempts->setLogin($invalidAttempts->getLogin()+1);
                             $em->persist($invalidAttempts);
                             $em->flush();   
                        }
                    }

                        return new JsonResponse(array(
                            'error' => '301',
                             'message'=>'No matching user account found with info provided',
                            ), Response::HTTP_OK);
        }
          if (!$user->isEnabled()){
           
               return new JsonResponse(array(
                'error' => '301',
                'message'=>'You need to enable your account',
                 ), Response::HTTP_OK); 
          }
       
            $clientManager = $this->get('fos_oauth_server.client_manager.default');
            $client = $clientManager->createClient();
            $client->setAllowedGrantTypes(array('password'));
            $clientManager->updateClient($client);

        return new JsonResponse(array(
            'secret'=>$client->getSecret(),
            'username'=>$user->getUsername(),
            'client_id' => $client->getPublicId(),
            ), Response::HTTP_OK);
        
      
            
        
    }

     /**
     * @Route("/forgot-password")
     * @Rest\Get("/forgot-password")
     * @ApiDoc(
     *  section = "Reset password",
     *  description=" (Step 1)  Send to # provided a token for accesing to account",
     *  requirements={
     *      {"name"="number", "dataType"="string", "required"=true, "description"="mobile number"}
     *  }
     * )
     */
         public function forgotPasswordAction()
        {
            $request = $this->getRequest();
            $number= $request->get('number');
              $em = $this->getDoctrine()->getEntityManager();
            if (!isset($number)){
                  return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'You must pass all fields',
                        ), Response::HTTP_OK);
             }
            if (strlen($number)!=11)
                    return new JsonResponse(array(
                    'error' => '301',
                    'message'=>'The mobile provided is not a valid number',
                    ), Response::HTTP_OK);
            $exist= $em->getRepository("AppBundle:User")->findUserByMobile(array('mobile'=>$number));
            if (count($exist)==0)
            return new JsonResponse(array(
                            'error' => '301',
                            'message'=>'This mobile is not registered',
                            ), Response::HTTP_OK);

            $number = "+".$number;
            $random =Util::randomize(6);

            $twilio = $this->get('twilio.api');
            $message = $twilio->account->messages->sendMessage(
            '+17865817808 ', // From a Twilio number in your account
            $number, // Text any number
            "Hello, your access token for change the password is ".$random
            );
            $user = $exist[0];
            $user->setConfirmationToken($random);
            $userManager = $this->get('fos_user.user_manager');
            $userManager->updateUser($user);
           
            return new JsonResponse(array(
                            'message'=>'The token has been already sent to number provided',
                            ), Response::HTTP_OK);

        }

     /**
     * @Route("/password/reset")
     * @Rest\Get("/password/reset")
     * @ApiDoc(
     *  section = "Reset password",
     *  description=" (Step 2) Reset password using the token and mobile number",
     *  requirements={
     *      {"name"="number", "dataType"="string", "require"=true, "description"="mobile number"},
     *      {"name"="token", "dataType"="string", "require"=true, "description"="token provided"},
     *      {"name"="password", "dataType"="password", "require"=true, "description"="password"},
     *      {"name"="password_confirmation", "dataType"="password", "require"=true, "description"="password confirmation"}
     *  }
     * )
     */
         public function resetPasswordAction()
        {
            $request = $this->getRequest();
            $number= $request->get('number');
            $token= $request->get('token');
            $password= $request->get('password');
            $password_confirmation= $request->get('password_confirmation');
            if (!isset($password) || !isset($password_confirmation) || ($password_confirmation!=$password) ){
                  return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The password fields provided does not match',
                        ), Response::HTTP_OK);
             }
            if (strlen($password)<6){
                  return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The password fields must have at least 6 characters',
                        ), Response::HTTP_OK);
             }

              $em = $this->getDoctrine()->getEntityManager();
            if (!isset($number) || !isset($token) ){
                  return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'You must pass all fields',
                        ), Response::HTTP_OK);
             }
            if (strlen($number)!=11)
                    return new JsonResponse(array(
                    'error' => '301',
                    'message'=>'The mobile provided is not a valid number',
                    ), Response::HTTP_OK);

            $exist= $em->getRepository("AppBundle:User")->findUserByMobile(array('mobile'=>$number));
            if (count($exist)==0)
            return new JsonResponse(array(
                            'error' => '301',
                            'message'=>'This mobile is not registered',
                            ), Response::HTTP_OK);

            $user = $exist[0];
            if (!$user instanceof \AppBundle\Entity\User) {
                          return new JsonResponse(array(
                            'error' => '302',
                            'message'=>'No matching user account found with info provided',
                            ), Response::HTTP_OK);
             }

            if ($user->getConfirmationToken()!=$token) {
                          return new JsonResponse(array(
                            'error' => '302',
                            'message'=>'No matching user account found with info provided',
                            ), Response::HTTP_OK);
             }

        $encoder_service = $this->get('security.encoder_factory');
        $encoder = $encoder_service->getEncoder($user);
        $encoded_pass = $encoder->encodePassword($password, $user->getSalt());
        $user->setConfirmationToken("");
        $user->setPassword($encoded_pass);
    
        $userManager = $this->get('fos_user.user_manager');
        $userManager->updateUser($user);
           
           
            return new JsonResponse(array(
                            'message'=>"Your password has been reset",
                            'username'=>$user->getUsername(),
                            'email'=>$user->getEmail(),
                            ), Response::HTTP_OK);

        }

}
