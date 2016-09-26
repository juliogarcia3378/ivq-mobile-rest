<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\Security\Core\Exception\AccessDeniedException;
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
     *  description="Returns a collection of Object",
     *  requirements={
     *      {
     *          "name"="limit",
     *          "dataType"="integer",
     *          "requirement"="\d+",
     *          "description"="how many objects to return"
     *      }
     *  },
     *  parameters={
     *      {"name"="categoryId", "dataType"="integer", "required"=true, "description"="category id"}
     *  }
     * )
     */
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');

           $user = $userManager->findUserBy(array('username' => 'admin'));



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
}
