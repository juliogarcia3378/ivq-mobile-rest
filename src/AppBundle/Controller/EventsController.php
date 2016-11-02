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


class EventsController extends FOSRestController
{

     /**
     * @Route("/event/list")
     * @Rest\Get("/event/list")
     * @ApiDoc(
     *  section = "Events",
     *  description="Return the events by group provided",
     *  requirements={
     *      {
     *          "name"="group",
     *          "dataType"="string",
     *          "description"=" Search the events by group_id"
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
      public function listEventAction()
        {
         $request = $this->getRequest();
         $group = $request->get('group',NULL);
         $array["group"]=$group;

         $em = $this->getDoctrine()->getEntityManager();
         $array["start"]=$this->getRequest()->get("start");
         $array["limit"]=$this->getRequest()->get("limit");
        $events = $em->getRepository("AppBundle:Event")->byGroup($array);
        $pagination["start"]=$this->getRequest()->get("start");
        $pagination["limit"]=$this->getRequest()->get("limit");
        $pagination["elements"]=count($events);

         return new JsonResponse(array('pagination'=>$pagination, "events"=>$events));
        }

     /**
     * @Route("/event/detail")
     * @Rest\Get("/event/detail")
     * @ApiDoc(
     *  section = "Events",
     *  description="Return the event by id provided",
     *  requirements={
     *      {
     *          "name"="event_id",
     *          "dataType"="string",
     *          "description"=" Search the event by event_id"
     *      }
     *              }
     * )
     */
      public function detailsEventAction()
        {
         $request = $this->getRequest();
         $_event = $request->get('event_id',NULL);
         $array["event"]=$_event;

         $em = $this->getDoctrine()->getEntityManager();
         $event = $em->getRepository("AppBundle:Event")->byId($array);
         return new JsonResponse(array( "event"=>$event));
        }



     
 }