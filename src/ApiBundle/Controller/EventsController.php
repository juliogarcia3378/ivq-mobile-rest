<?php

namespace ApiBundle\Controller;

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
use Core\ComunBundle\Util\UtilRepository2;


class EventsController extends FOSRestController
{


               /**
     * @Route("/event/dislike")
     * @Rest\Get("/event/dislike")
     * @ApiDoc(
     *  section = "Events",
     *  description="Dislike an event",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
                "description"="event Id "
     *      }
     *              }
     * )
     */
      public function disLikeEventAction()
        {
       $request = $this->getRequest();
         $id = $request->get('id',NULL);
          if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
         $array["user"]=$user;
         $em = $this->getDoctrine()->getEntityManager();
         $event = $em->getRepository("AppBundle:Event")->find($id);
         if ($event==null){
              return new JsonResponse(array('message'=>"This is an invalid event."));
         }
         $array["event"]=$event;
         
         $response = $em->getRepository("AppBundle:Event")->dislike($array);
         return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You haven't permissions to access this functionality."));
    }


                     /**
     * @Route("/event/like")
     * @Rest\Get("/event/like")
     * @ApiDoc(
     *  section = "Events",
     *  description="Like an event ",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
                "description"="event Id "
     *      }
     *              }
     * )
     */
      public function addLiketoEventAction()
        {
       $request = $this->getRequest();
         $id = $request->get('id',NULL);
          if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
         $array["user"]=$user;
         $em = $this->getDoctrine()->getEntityManager();
         $event = $em->getRepository("AppBundle:Event")->find($id);
         if ($event==null){
              return new JsonResponse(array('message'=>"This is an invalid event."));
         }
         $array["event"]=$event;
         
         $response = $em->getRepository("AppBundle:Event")->like($array);
         return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You haven't permissions to access this functionality."));


    }

}
