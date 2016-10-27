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


class GroupController extends FOSRestController
{

     /**
     * @Route("/group/list")
     * @Rest\Get("/group/list")
     * @ApiDoc(
     *  section = "Groups",
     *  description="Return the list of groups by filters provided",
     * )
     */
      public function listGroupsAction()
        {

            $em = $this->getDoctrine()->getEntityManager();
            $groups = $em->getRepository("AppBundle:MyGroups")->findAll();

              $array = array();
              foreach ($groups as $key => $group) {
                $aux["id"]=$group->getId();
                $aux["name"]=$group->getName();
                $aux["description"]=$group->getDescription();
                $aux["phone"]=$group->getPhone();
                $aux["email"]=$group->getPhone();
                $aux["website"]=$group->getPhone();
                $aux["logo"]=$group->getLogo();
                $aux["address"]=$group->getAddress()->getDescription();
                $aux["category"]=$group->getCategory()->getName();
                $array[]=$aux;
             }


            return new JsonResponse(array( "groups"=>$array));
        }

      /**
     * @Route("/group/join")
     * @Rest\Get("/group/join")
     * @ApiDoc(
     *  section = "Groups",
     *  description="**********NOT READY *************Join to a group",
     * )
     */
      public function joinGroupAction()
        {

            $em = $this->getDoctrine()->getEntityManager();
            $groups = $em->getRepository("AppBundle:MyGroups")->findAll();
              $array = array();
              foreach ($groups as $key => $group) {
                $aux["id"]=$group->getId();
                $aux["name"]=$group->getName();
                $aux["description"]=$group->getDescription();
                $aux["phone"]=$group->getPhone();
                $aux["email"]=$group->getPhone();
                $aux["website"]=$group->getPhone();
                $aux["logo"]=$group->getLogo();
                $aux["address"]=$group->getAddress()->getDescription();
                $aux["category"]=$group->getCategory()->getName();
                $array[]=$aux;
             }
            return new JsonResponse(array( "groups"=>$array));
        }

     /**
     * @Route("/group/disjoin")
     * @Rest\Get("/group/disjoin")
     * @ApiDoc(
     *  section = "Groups",
     *  description="**********NOT READY *************Disjoin to a group",
     * )
     */
      public function disJoinGroupAction()
        {

            $em = $this->getDoctrine()->getEntityManager();
            $groups = $em->getRepository("AppBundle:MyGroups")->findAll();
              $array = array();
              foreach ($groups as $key => $group) {
                $aux["id"]=$group->getId();
                $aux["name"]=$group->getName();
                $aux["description"]=$group->getDescription();
                $aux["phone"]=$group->getPhone();
                $aux["email"]=$group->getPhone();
                $aux["website"]=$group->getPhone();
                $aux["logo"]=$group->getLogo();
                $aux["address"]=$group->getAddress()->getDescription();
                $aux["category"]=$group->getCategory()->getName();
                $array[]=$aux;
             }
            return new JsonResponse(array( "groups"=>$array));
        }
     /**
     * @Route("/group/members")
     * @Rest\Get("/group/members")
     * @ApiDoc(
     *  section = "Groups",
     *  description="******* NOT READY *********Return the members by group provided",
     *  requirements={
     *      {
     *          "name"="group",
     *          "dataType"="string",
     *          "description"=" Search the members by group_id"
     *      }
     *              }
     * )
     */
      public function listMemberAction()
        {
         $request = $this->getRequest();
         $group = $request->get('group',NULL);
         $array["group"]=$group;

         $em = $this->getDoctrine()->getEntityManager();
         $events = $em->getRepository("AppBundle:Member")->byGroup($array);
         return new JsonResponse(array( "events"=>$events));
        }

     
 }