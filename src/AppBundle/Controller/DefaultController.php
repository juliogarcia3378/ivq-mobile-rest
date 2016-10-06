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

class DefaultController extends FOSRestController
{
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
    public function indexAction()
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
        if (!$user instanceof \Acme\ApiBundle\Entity\User) {
                          return new JsonResponse(array(
                            'error' => '301',
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

     /**
     * @Route("/forgot-password")
     * @Rest\Get("/forgotten-password")
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
