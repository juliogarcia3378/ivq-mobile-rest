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
use Core\ComunBundle\Util\UtilRepository2;



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
       if ($group=='')
       {
         return new JsonResponse(array(
                                    'error'=>"The group is not valid.",
                                    ), Response::HTTP_OK);
       }
         if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
              $array["group"]=$group;
                $array["user"]=$user->getId();
                $em = $this->getDoctrine()->getEntityManager();
                $member = $em->getRepository("AppBundle:Groups")->isMember($array);
                 if ($member==true)
                 {
                    return new JsonResponse(array( "message"=>"You are currently a member in this group."));  
                 }
                   else
                 {
                     return new JsonResponse(array("message"=>$em->getRepository("AppBundle:Member")->joinGroup($user,$group)));
                 }

         }
            return new JsonResponse(array(
                                    'error' => '301',
                                    'message'=>"You haven't permissions for this requirement" ,
                                    ), Response::HTTP_OK);
           
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
       if ($group=='')
       {
         return new JsonResponse(array(
                                    'error'=>"The group is not valid.",
                                    ), Response::HTTP_OK);
       }
         if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
                $em = $this->getDoctrine()->getEntityManager();
                return new JsonResponse(array( "message"=>$em->getRepository("AppBundle:Member")->disjoinGroup($user->getId(),$group)));
         }
            return new JsonResponse(array(
                                    'error' => '301',
                                    'message'=>"You haven't permissions for this requirement" ,
                                    ), Response::HTTP_OK);
           
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
            if ($group==NULL)
                 {
                    return new JsonResponse(array( "message"=>"The group  is not valid."));  
                 }
           if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
              
                $array["group"]=$group;
                $array["user"]=$user->getId();
                $em = $this->getDoctrine()->getEntityManager();
                $member = $em->getRepository("AppBundle:Groups")->isMember($array);

                 if ($member==false)
                 {
                    return new JsonResponse(array( "message"=>"You need to be a member for listing members in this group."));  
                 }
                   else
                 {
                     $array = array();
                     $array["group"]=$group;

                      $start = UtilRepository2::getContainer()->get('request')->get('start');
                      $size = UtilRepository2::getContainer()->get('request')->get('limit');
                      UtilRepository2::getSession()->set("start", $start);
                      UtilRepository2::getSession()->set("limit", $size);
                      $array["start"]=$start;
                      $array["limit"]=$size;

                     $members = $em->getRepository("AppBundle:Member")->listMembersByGroup($array);
                     $pagination= UtilRepository2::paginate();

                    return new JsonResponse(array("pagination"=>$pagination,"members"=>$members));

                 }

            }
            return new JsonResponse(array(
                                    'error' => '301',
                                    'message'=>"You haven't permissions for this functionality" ,
                                    ), Response::HTTP_OK);
         
         
        }

        /**
     * @Route("/my-groups")
     * @Rest\Get("/my-groups")
     * @ApiDoc(
     *  section = "Groups",
     *  description="Return My Groups",
     * )
     */
      public function listMyGroupAction()
        {
         $request = $this->getRequest();
        
           if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
              
                     $members = $user->getMembers();
                     $response = array();
                     foreach ($members as $key => $member) {
                        $array['id']=$member->getGroups()->getId();
                        $array['name']=$member->getGroups()->getName();
                        $array['category']=$member->getGroups()->getCategory()->getName();
                        $array['logo']=$member->getGroups()->getLogo()->getURL();
                        $array['address']=$member->getGroups()->getAddress()->getCityAndState();
                         $response[]=$array;
                     }
                    return new JsonResponse(array("groups"=>$response));
                 }
             return new JsonResponse(array( "message"=>"You aren't a valid user."));
        }

    

            /**
     * @Route("/group/view")
     * @Rest\Get("/group/view")
     * @ApiDoc(
     *  section = "Groups",
     *  description="View Group",
        *  requirements={
     *      {
     *          "name"="group",
     *          "dataType"="string",
     *          "description"=" View group"
     *      }
     }
     * )
     */
      public function viewGroupAction()
        {
         $request = $this->getRequest();
        $group = $request->get('group',NULL);
            if ($group==NULL)
                 {
                    return new JsonResponse(array( "message"=>"The group is not valid."));  
                 }
           if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                
              
                $em = $this->getDoctrine()->getEntityManager();
                 $group = $em->getRepository("AppBundle:Groups")->find($group);

                     $response = array();
                        $array['id']=$group->getId();
                         $array['name']=$group->getName();
                        $array['category']=$group->getCategory()->getName();
                        $array['address']=$group->getAddress()->getAddress();
                        $array['city']=$group->getAddress()->getCity();
                        $array['state']=$group->getAddress()->getState()->getName();
                        $array['logo']=$group->getLogo()->getURL();
                        $array['phone']=$group->getPhone();
                        $array['information']=$group->getDescription();
                         $response[]=$array;
                    return new JsonResponse(array("groups"=>$response));
                 }
             return new JsonResponse(array( "message"=>"You aren't a valid user."));
        }

     
 }