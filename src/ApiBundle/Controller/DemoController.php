<?php

// src/Acme/ApiBundle/Controller/DemoController.php

namespace ApiBundle\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FOS\RestBundle\Controller\FOSRestController;

class DemoController extends FOSRestController
{

      /**
     * @Route("/testing")
     * @Rest\Get("/testing")
     * @ApiDoc(
     *  section = "Testing",
     *  description="*** This API Call is just for testing ",
     * )
     */
    public function getDemosAction()
    {

        $em = $this->getDoctrine()->getEntityManager();
                     $array = array();
                     $array["group"]=1;
                     $members = $em->getRepository("AppBundle:User")->find(41)->getFollower();
                     $following = $em->getRepository("AppBundle:User")->find(41)->getFollowing();
                     echo "<pre>";
                      var_dump(count($following));
                     var_dump(count($members));die;

                     return new JsonResponse(array( "members"=>$members));
    }
}