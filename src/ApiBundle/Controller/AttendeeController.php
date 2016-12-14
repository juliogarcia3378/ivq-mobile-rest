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
use Core\ComunBundle\Enums\ENotification;
use AppBundle\Entity\Notification;
use Core\ComunBundle\Util\UtilRepository2;


class AttendeeController extends FOSRestController
{



     /**
     * @Route("/event/attendees")
     * @Rest\Get("/event/attendees")
     * @ApiDoc(
     *  section = "Events",
     *  description="List the attendees to event ",
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

        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) 
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $array["user"]=$user->getId();
            $array["event"]=$_event;
            $em = $this->getDoctrine()->getManager();
            $event = $em->getRepository("AppBundle:Attendee")->find($array["event"]);
            if ($event==null)
                return new JsonResponse(array('message'=>"This is not a valid event."));
            $array["group"]=$event->getGroups()->getId();
            
            $member = $em->getRepository("AppBundle:Groups")->isMember($array);
                if ($member==false)
                {
                    return new JsonResponse(array('message'=>"Please join this group to access this feature.")); 
                }
            $array["start"]=$this->getRequest()->get("start");
            $array["limit"]=$this->getRequest()->get("limit");
            UtilRepository2::getSession()->set("start", $array['start']);
            UtilRepository2::getSession()->set("limit", $array['limit']);

            $attendees = $em->getRepository("AppBundle:Attendee")->byEvent($array);
            $pagination= UtilRepository2::paginate();

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
        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) 
        {
            $user = $this->get('security.context')->getToken()->getUser();
            if ($user->getProfile()==null){
                return new JsonResponse(array('message'=>"Is required that you update your profile before attend this event."));
            }
              
            $array["user"]=$user;
            $em = $this->getDoctrine()->getManager();
            $event = $em->getRepository("AppBundle:Event")->find($_event);
            if ($event==null){
                  return new JsonResponse(array('message'=>"This is an invalid event."));
            }
            $array["event"]=$event;
            
            $myMembership= $em->getRepository("AppBundle:Member")->returnMemberID(array('user'=>$user->getId(),'group'=>$event->getGroups()->getId()));
            if ($myMembership==null){
                     return new JsonResponse(array('message'=>"Please join this group to rsvp to this event ."));
            }
            $myMember= $em->getRepository("AppBundle:Member")->find($myMembership);
            
            $notification = new Notification();
            $notification->setMember($myMember);
            //$notification->setPicture("");
            $notification->setEvent($event);
            $notification->setNotificationType($em->getRepository("AppBundle:NotificationType")->find(ENotification::ATTEND_TO_EVENT));
            $em->persist($notification);
             
         
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

        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE)
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $em = $this->getDoctrine()->getManager();
            $event = $em->getRepository("AppBundle:Event")->find($_event);
            if ($event==null)
            {
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