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

class SecurityController extends FOSRestController
{

     /**
     * @Route("/register")
     * @Rest\Get("/register")
     * @ApiDoc(
     *  description="Register new user as consumer",
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
     *          "description"="Mobile number for the current account"
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
            'id' => $user->getId()
            ), Response::HTTP_OK);
    }

    /**
     * @Route("/login")
     * @Rest\Get("/login")
     * @ApiDoc(
     *  description="Returns the secret_id and the client_id",
     *  requirements={
     *      {
     *          "name"="username",
     *          "dataType"="string",
     *          "description"="username"
     *      },
          *      {
     *          "name"="password",
     *          "dataType"="string",
     *          "description"="password"
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

        if ($encoded_pass != $user->getPassword()) {
                        return new JsonResponse(array(
                            'error' => '301',
                             'message'=>'No matching user account found with info provided',
                            ), Response::HTTP_OK);
        }
         
        if ($user->isEnabled()){
            $clientManager = $this->get('fos_oauth_server.client_manager.default');
            $client = $clientManager->createClient();
            $client->setAllowedGrantTypes(array('password'));
            $clientManager->updateClient($client);

        return new JsonResponse(array(
            'id' => $user->getId(),
            'secret'=>$client->getSecret(),
            'client_id' => $client->getPublicId(),
            ), Response::HTTP_OK);
        }
        else {
            return new JsonResponse(array(
                'error' => '301',
                'message'=>'You need to enable your account',
                 ), Response::HTTP_OK); 
        }
    }

     /**
     * @Route("/forgot-password")
     * @Rest\Get("/forgot-password")
     * @ApiDoc(
     *  description="Send to # provided a token for accesing to account",
     *  requirements={
     *      {
     *          "name"="limit",
     *          "dataType"="string",
     *          "description"="Send a message through Twilio API Services"
     *      }
     *  },
     *  parameters={
     *      {"name"="number", "dataType"="string", "required"=true, "description"="mobile number"}
     *  }
     * )
     */
         public function forgotPasswordAction()
        {
             $request = $this->getRequest();

            $number= $request->get('number');
            $number = "+".$number;


            $twilio = $this->get('twilio.api');
            $message = $twilio->account->messages->sendMessage(
          '+17865817808 ', // From a Twilio number in your account
          $number, // Text any number
          "Hello monkey!"
        );

            $otherInstance = $twilio->createInstance('BBBB', 'CCCCC');
            return new Response($message->sid);
        }


}
