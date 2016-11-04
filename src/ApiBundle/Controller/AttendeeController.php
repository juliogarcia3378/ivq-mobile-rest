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


class AttendeeController extends FOSRestController
{



     /**
     * @Route("/event/attendees")
     * @Rest\Get("/event/attendees")
     * @ApiDoc(
     *  section = "Events",
     *  description="(OK) List the attendees to event ",
     *  requirements={
     *      {
     *          "name"="event_id",
     *          "dataType"="string",
     *          "description"=" Event Id provided in event's list"
     *      },
     *      {
     *          "name"="start",
     *          "dataType"="string",
     *          "description"=" First Element requested"
     *      },
     *      {
     *          "name"="limit",
     *          "dataType"="string",
     *          "description"="Total of elements requested"
     *      }
     *              }
     * )
     */
      public function attendeesAction()
        {
         $request = $this->getRequest();
         $_event = $request->get('event_id',NULL);

         if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
        $array["user"]=$user->getId();
         $array["event"]=$_event;
         $em = $this->getDoctrine()->getEntityManager();

         $array["start"]=$this->getRequest()->get("start");
         $array["limit"]=$this->getRequest()->get("limit");

         $attendees = $em->getRepository("AppBundle:Attendee")->byEvent($array);
         $pagination["start"]=$this->getRequest()->get("start");
         $pagination["limit"]=$this->getRequest()->get("limit");
         $pagination["elements"]=count($attendees);

         return new JsonResponse(array('pagination'=>$pagination, "attendees"=>$attendees));
        }
        return new JsonResponse(array('message'=>"You haven't permissions for listing attendees in this event."));
    }


     /**
     * @Route("/event/confirm")
     * @Rest\Get("/event/confirm")
     * @ApiDoc(
     *  section = "Events",
     *  description="(OK) Confirm attendance to event ",
     *  requirements={
     *      {
     *          "name"="event_id",
     *          "dataType"="string",
     *          "description"=" Event Id provided in event's list"
     *      },
     *              }
     * )
     */
      public function confirmAttendanceAction()
        {
         $request = $this->getRequest();
         $_event = $request->get('event_id',NULL);
          if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
         $array["user"]=$user;
         $em = $this->getDoctrine()->getEntityManager();
         $event = $em->getRepository("AppBundle:Event")->find($_event);
         if ($event==null){
              return new JsonResponse(array('message'=>"This is an invalid event."));
         }
         $array["event"]=$event;
         
         $response = $em->getRepository("AppBundle:Attendee")->confirmAttendance($array);
         return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You haven't permissions to assist this event."));

    }

     /**
     * @Route("/event/cancel")
     * @Rest\Get("/event/cancel")
     * @ApiDoc(
     *  section = "Events",
     *  description="(OK) Cancel attendance to event ",
     *  requirements={
     *      {
     *          "name"="event_id",
     *          "dataType"="string",
     *          "description"=" Event Id provided in event's list"
     *      },
     *              }
     * )
     */
      public function cancelAttendanceAction()
        {
         $request = $this->getRequest();
         $_event = $request->get('event_id',NULL);

        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              

         $em = $this->getDoctrine()->getEntityManager();
         $event = $em->getRepository("AppBundle:Event")->find($_event);
        
         if ($event==null){
              return new JsonResponse(array('message'=>"This is an invalid event."));
         }
         $array["user"]=$user;
         $array["event"]=$event;

         $response = $em->getRepository("AppBundle:Attendee")->cancelAttendance($array);
         return new JsonResponse(array('message'=>$response));
        } 

     return new JsonResponse(array('message'=>"You haven't permissions to this event."));
     
       }
}