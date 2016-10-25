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
     *      }
     *              }
     * )
     */
      public function listEventAction()
        {
         $request = $this->getRequest();
         $group = $request->get('group',NULL);

            $em = $this->getDoctrine()->getEntityManager();
            $events = $em->getRepository("AppBundle:Event")->createQueryBuilder('a')
            ->join('a.groups', 'g')
            ->where('g.id = :group')
            ->setParameter('group', $group)
               ->select('a')
               ->getQuery()
               ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            return new JsonResponse(array( "events"=>$events));
        }

        


     
 }