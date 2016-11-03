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

class LinkedinController extends FOSRestController
{


    /**
     * @Route("/linkedin/login")
     * @Rest\Get("/linkedin/login")
     * @ApiDoc(
     *  section = "Linkedin", 
     *  description="(Step 1)   Returns the secret_id and the client_id for the user",
     *  parameters={
     *      {
     *          "name"="linkedinID",
     *          "dataType"="string",
     *          "description"="ID provided by linkedinAPI",
     *          "required"="true"
     *      },
     *      {
     *          "name"="email",
     *          "dataType"="string",
     *          "description"="Email for the current account",
     *          "required"="true"
     *      },
     *  },
     * )
     */
    public function linkedinLoginAction()
    {
        $request = $this->getRequest();
        $linkedinID = $request->get('linkedinID',NULL);
        $email = $request->get('email',NULL);
        $password=$linkedinID;
        
        $um = $this->get('fos_user.user_manager');
        $em = $this->getDoctrine()->getEntityManager();
         $exist = $em->getRepository("AppBundle:User")->findUserByLinkedinID(array('linkedinID'=>$linkedinID));
          $user = $um->findUserByUsernameOrEmail($email);
        if (count($exist)==0) 
        {
          if(count($user)==0)
          {
            $user = $um->createUser();
            $user->setUsername($email);
            $user->setEmail($email);
            $user->setConfirmationToken("");
            $user->addRoleMember();
            $user->setEnabled(true);

            $encoder_service = $this->get('security.encoder_factory');
            $encoder = $encoder_service->getEncoder($user);
            $encoded_pass = $encoder->encodePassword($linkedinID, $user->getSalt());
            $user->setPassword($encoded_pass);

         }

            $user->setLinkedinID($linkedinID);
            $um->updateUser($user);
        } else{
            if (!($exist[0]->getLinkedinID()==$linkedinID && $exist[0]->getEmail()==$email)){
             return new JsonResponse(array(
            'message' => "The Linkedin information provided is not accurate",
            ), Response::HTTP_OK);
            }
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

   
}
