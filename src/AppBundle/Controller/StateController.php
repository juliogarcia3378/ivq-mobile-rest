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
use ApiBundle\Repository\CountryRepository;


class StateController extends FOSRestController
{

     /**
     * @Route("/country/list")
     * @Rest\Get("/country/list")
     * @ApiDoc(
     *  section = "State/Country",
     *  description="Return the list of all countries",
     * )
     */
      public function countryAction()
        {

            $em = $this->getDoctrine()->getEntityManager();
            $countries = $em->getRepository("AppBundle:Country")->createQueryBuilder('c')
               ->select('c')
               ->getQuery()
               ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            return new JsonResponse(array( "countries"=>$countries));
        }


     /**
     * @Route("/state/list")
     * @Rest\Get("/state/list")
     * @ApiDoc(
     *  section = "State/Country",
     *  description="Return the list of all states (by default USA)",
     * )
     */
      public function stateAction()
        {
            $em = $this->getDoctrine()->getEntityManager();
            $states = $em->getRepository("AppBundle:State")->createQueryBuilder('c')
               ->select('c')
               ->getQuery()
               ->getResult(\Doctrine\ORM\Query::HYDRATE_ARRAY);
            return new JsonResponse(array( "states"=>$states));
        }

     
 }