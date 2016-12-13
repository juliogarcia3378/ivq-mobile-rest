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
use Core\ComunBundle\Util\UtilRepository2;


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
        $pagination["start"]=($this->getRequest()->get("start")!=null) ? ($this->getRequest()->get("start")): 0;
        $pagination["limit"]=$this->getRequest()->get("limit");
        $pagination["elements"]=count($events);
          UtilRepository2::getSession()->set("start",$pagination["start"]);
          UtilRepository2::getSession()->set("limit",$pagination["limit"]);

         return new JsonResponse(array('pagination'=>UtilRepository2::paginate(), "events"=>$events));
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

     /**
     * @Route("/event/media/list")
     * @Rest\Get("/event/media/list")
     * @ApiDoc(
     *  section = "Events",
     *  description="Return the events by group provided",
     *  requirements={
     *      {
     *          "name"="event",
     *          "dataType"="string",
     *          "description"=" Search the events by event_id"
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
      public function listMediaByEventAction()
        {
         $request = $this->getRequest();
         $event = $request->get('event',NULL);
         $array["event"]=$event;

         $em = $this->getDoctrine()->getEntityManager();
         $array["start"]=$this->getRequest()->get("start");
         $array["limit"]=$this->getRequest()->get("limit");

         if ($array['start']==null)
            $array['start']=0;
        if ($array['limit']==null)
            $array['limit']=10;
        UtilRepository2::getSession()->set("start", $array["start"] );
        UtilRepository2::getSession()->set("limit", $array["limit"]);

        $media = $em->getRepository("AppBundle:MediaEvent")->byEvent($array);
         $pagination = UtilRepository2::paginate();

         return new JsonResponse(array('pagination'=>$pagination, "media"=>$media));
        }






    
     
 }
