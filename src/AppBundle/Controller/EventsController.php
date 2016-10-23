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
     *  section = "sdfsdf",
     *  description="Return the list of groups by filters provided",
     * )
     */
      public function listEventAction()
        {
            $em = $this->getDoctrine()->getEntityManager();
            $events = $em->getRepository("AppBundle:Event")->createQueryBuilder('c')
               ->select('c')
               ->getQuery()
               ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            return new JsonResponse(array( "events"=>$events));
        }

        


     
 }