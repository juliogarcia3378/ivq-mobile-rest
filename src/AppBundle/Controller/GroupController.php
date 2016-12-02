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


class GroupController extends FOSRestController
{

     /**
     * @Route("/group/list")
     * @Rest\Get("/group/list")
     * @ApiDoc(
     *  section = "Groups",
     *  description="Return the list of groups by filters provided",
      *  requirements={
     *      {
     *          "name"="start",
     *          "dataType"="string",
     *          "description"="First Element"
     *      },
     *      {
     *          "name"="limit",
     *          "dataType"="string",
     *          "description"="Total of elements requested"
     *      }
     *              }
     * )
     */
      public function listGroupsAction()
        {

            $em = $this->getDoctrine()->getEntityManager();
            $array = array();
            
            $groups = $em->getRepository("AppBundle:Groups")->obtenerTodos($array);
             $total = count($em->getRepository("AppBundle:Groups")->findAll());
              $array = array();
              $i=0;
              foreach ($groups as $key => $group) {
                $aux["id"]=$group->getId();
                $aux["name"]=$group->getName();
                $aux["description"]=$group->getDescription();
                $aux["phone"]=$group->getPhone();
                $aux["email"]=$group->getEmail();
                $aux["website"]=$group->getPhone();
                $aux["logo"]=$group->getLogo();
                $aux["address"]=$group->getAddress()->getDescription();
                $aux["category"]=$group->getCategory()->getName();
                $array[]=$aux;
             }


            $pagination= UtilRepository2::paginate();
            return new JsonResponse(array("pagination"=>$pagination,"groups"=>$array));
        }
       

     /**
     * @Route("/nearby")
     * @Rest\Get("/nearby")
     * @ApiDoc(
     *  section = "Groups",
     *  description="Return Nearby Groups",
      *  requirements={
         *      {
     *          "name"="start",
     *          "dataType"="string",
     *          "description"="First Element"
     *      },
     *      {
     *          "name"="limit",
     *          "dataType"="string",
     *          "description"="Total of elements requested"
     *      },
     *      {
     *          "name"="zip",
     *          "dataType"="string",
     *          "description"=" Search the groups by zip code provided"
     *      }
     *              }
     * )
     */
      public function listNearbyGroupsAction()
        {
           $request = $this->getRequest();
            $em = $this->getDoctrine()->getEntityManager();
            $zip = $request->get('zip',NULL);
            $array["zip"]=$zip;

            $groups = $em->getRepository("AppBundle:Groups")->searchNearby($array);
             $total = count($groups);
              $array = array();
              $i=0;
              foreach ($groups as $key => $group) {
                $aux["id"]=$group->getId();
                $aux["name"]=$group->getName();
                $aux["description"]=$group->getDescription();
                $aux["phone"]=$group->getPhone();
                $aux["email"]=$group->getEmail();
                $aux["website"]=$group->getPhone();
                $aux["logo"]=$group->getLogo();
                $aux["address"]=$group->getAddress()->getDescription();
                $aux["category"]=$group->getCategory()->getName();
                $array[]=$aux;
             }
              

            $pagination= UtilRepository2::paginate();
            return new JsonResponse(array("pagination"=>$pagination,"groups"=>$array));
        }


      /**
     * @Route("/group/search")
     * @Rest\Get("/group/search")
     * @ApiDoc(
     *  section = "Groups",
     *  description="Return the list of groups by filters provided",
     *  requirements={
     *      {
     *          "name"="category",
     *          "dataType"="string",
     *          "description"="category ID"
     *      },
     *      {
     *          "name"="search",
     *          "dataType"="string",
     *          "description"="String value to search"
     *      },
     *      {
     *          "name"="start",
     *          "dataType"="string",
     *          "description"="First Element"
     *      },
     *      {
     *          "name"="limit",
     *          "dataType"="string",
     *          "description"="Total of elements requested"
     *      }
     *              }
     * )
     */
      public function searchGroupsAction()
        {
            $request = $this->getRequest();
            $em = $this->getDoctrine()->getEntityManager();
            $search = $request->get('search',NULL);
            $category = $request->get('category',NULL);
            $array["search"]=$search;
            $array["category"]=$category;

            $groups = $em->getRepository("AppBundle:Groups")->search($array);
             $total = count($em->getRepository("AppBundle:Groups")->findAll());
              $array = array();
              $i=0;
              foreach ($groups as $key => $group) {
                $aux["id"]=$group->getId();
                $aux["name"]=$group->getName();
                $aux["description"]=$group->getDescription();
                $aux["phone"]=$group->getPhone();
                $aux["email"]=$group->getEmail();
                $aux["website"]=$group->getPhone();
                $aux["logo"]=$group->getLogo();
                $aux["address"]=$group->getAddress()->getDescription();
                $aux["category"]=$group->getCategory()->getName();
                $array[]=$aux;
             }


            $pagination= UtilRepository2::paginate();
            return new JsonResponse(array("pagination"=>$pagination,"groups"=>$array));
        }

 }