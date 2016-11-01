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


class GroupController extends FOSRestController
{

    

      /**
     * @Route("/group/join")
     * @Rest\Get("/group/join")
     * @ApiDoc(
     *  section = "Groups",
     *  description="Join to a group",
     *  requirements={
     *      {
     *          "name"="group",
     *          "dataType"="string",
     *          "description"=" Group ID"
     *      }
     *              }
     * )
     */
      public function joinGroupAction()
        {
         $request = $this->getRequest();
         $group = $request->get('group',NULL);
         if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
              $array["group"]=$group;
                $array["user"]=$user->getId();
                $em = $this->getDoctrine()->getEntityManager();
                $member = $em->getRepository("AppBundle:Groups")->isMember($array);
                 if ($member==true)
                 {
                    return new JsonResponse(array( "message"=>"You are currently joined this group"));  
                 }
                   else
                 {
                     return new JsonResponse(array("message"=>$em->getRepository("AppBundle:Member")->joinGroup($user,$group)));
                 }

         }
          return new JsonResponse(array( "message"=>"You haven't permissions for listing members in this group"));
           
        }

          /**
     * @Route("/group/disjoin")
     * @Rest\Get("/group/disjoin")
     * @ApiDoc(
     *  section = "Groups",
     *  description="Disjoin to a group",
     *  requirements={
     *      {
     *          "name"="group",
     *          "dataType"="string",
     *          "description"=" Group ID"
     *      }
     *              }
     * )
     */
      public function disjoinGroupAction()
        {
         $request = $this->getRequest();
         $group = $request->get('group',NULL);
         if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
                $em = $this->getDoctrine()->getEntityManager();
                return new JsonResponse(array( "message"=>$em->getRepository("AppBundle:Member")->disjoinGroup($user->getId(),$group)));
         }
          return new JsonResponse(array( "message"=>"You haven't permissions for accesing in this group"));
           
        }
     /**
     * @Route("/group/members")
     * @Rest\Get("/group/members")
     * @ApiDoc(
     *  section = "Groups",
     *  description="Return the members by group provided",
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
           if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
              
                $array["group"]=$group;
                $array["user"]=$user->getId();
                $em = $this->getDoctrine()->getEntityManager();
                $member = $em->getRepository("AppBundle:Groups")->isMember($array);
                 if ($member==false)
                 {
                    return new JsonResponse(array( "message"=>"You haven't permissions for listing members in this group"));  
                 }
                   else
                 {
                     $array = array();
                     $array["group"]=$group;
                     $members = $em->getRepository("AppBundle:Member")->listMembersByGroup($array);
                     return new JsonResponse(array( "members"=>$members));
                 }

            }
             return new JsonResponse(array( "message"=>"You haven't permissions for listing members in this group"));
         
         
        }

     
 }