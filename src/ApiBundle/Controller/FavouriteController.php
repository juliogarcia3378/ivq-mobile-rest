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


class FavouriteController extends FOSRestController
{



     /**
     * @Route("/favorites/groups/list")
     * @Rest\Get("/favorites/groups/list")
     * @ApiDoc(
     *  section = "Favorite Groups",
     *  description="(OK) List the Favorite Groups ",
     *  requirements={
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
      public function listFavouriteGroupsAction()
        {
         $request = $this->getRequest();
        

         if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
        $array["user"]=$user->getId();
         $em = $this->getDoctrine()->getEntityManager();

         $array["start"]=$this->getRequest()->get("start");
         $array["limit"]=$this->getRequest()->get("limit");

         $groups = $em->getRepository("AppBundle:FavouriteGroup")->byUser($array);
         $pagination["start"]=$this->getRequest()->get("start");
         $pagination["limit"]=$this->getRequest()->get("limit");
         $pagination["elements"]=count($groups);
            if ($array['start']==null)
                $array['start']=0;
            if ($array['limit']==null)
                $array['limit']=10;
             UtilRepository2::getSession()->set("start", $array['start']);
             UtilRepository2::getSession()->set("limit", $array['limit']);
             $pagination =UtilRepository2::paginate();

         return new JsonResponse(array('pagination'=>$pagination, "groups"=>$groups));
        }
        return new JsonResponse(array('message'=>"You aren't a member."));
    }


     /**
     * @Route("/favorites/groups/add")
     * @Rest\Get("/favorites/groups/add")
     * @ApiDoc(
     *  section = "Favorite Groups",
     *  description="Add a new group to favorite list ",
     *  requirements={
     *      {
     *          "name"="group",
     *          "dataType"="string",
     *          "description"=" Group Id provided in group's list"
     *      },
     *              }
     * )
     */
      public function addGroupFavouriteAction()
        {
         $request = $this->getRequest();
         $_group = $request->get('group',NULL);
          if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
         $array["user"]=$user;
         $em = $this->getDoctrine()->getEntityManager();
         $group = $em->getRepository("AppBundle:Groups")->find($_group);
         if ($group==null){
              return new JsonResponse(array('message'=>"This is an invalid group."));
         }
         $array["groups"]=$group;
         
         $response = $em->getRepository("AppBundle:FavouriteGroup")->addFavorite($array);
         return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You haven't permissions to assist this event."));

    }

     /**
     * @Route("/favorites/groups/remove")
     * @Rest\Get("/favorites/groups/remove")
     * @ApiDoc(
     *  section = "Favorite Groups",
     *  description="(OK) Remove a group from the Favorite List ",
     *  requirements={
     *      {
     *          "name"="group",
     *          "dataType"="string",
     *          "description"=" Group Id provided in group's list"
     *      },
     *              }
     * )
     */
      public function removeGroupAction()
        {
         $request = $this->getRequest();
         $_group = $request->get('group',NULL);
          if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
         $array["user"]=$user;
         $em = $this->getDoctrine()->getEntityManager();
         $group = $em->getRepository("AppBundle:Groups")->find($_group);
         if ($group==null){
              return new JsonResponse(array('message'=>"This is an invalid group."));
         }
         $array["groups"]=$group;
         
         $response = $em->getRepository("AppBundle:FavouriteGroup")->removeFavorite($array);
         return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You haven't permissions to assist this event."));

     
       }


        /**
     * @Route("/favorites/members/list")
     * @Rest\Get("/favorites/members/list")
     * @ApiDoc(
     *  section = "Favorite Members",
     *  description="(OK) List the Favorite Members ",
     *  requirements={
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
      public function listFavouriteMembersAction()
        {
         $request = $this->getRequest();
        

         if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
        $array["user"]=$user->getId();
         $em = $this->getDoctrine()->getEntityManager();

         $array["start"]=$this->getRequest()->get("start");
         $array["limit"]=$this->getRequest()->get("limit");

         $members = $em->getRepository("AppBundle:FavouriteMember")->byUser($array);
         $pagination["start"]=$this->getRequest()->get("start");
         $pagination["limit"]=$this->getRequest()->get("limit");
            if ($array['start']==null)
                $array['start']=0;
            if ($array['limit']==null)
                $array['limit']=10;
             UtilRepository2::getSession()->set("start", $array['start']);
             UtilRepository2::getSession()->set("limit", $array['limit']);
             $pagination =UtilRepository2::paginate();


         return new JsonResponse(array('pagination'=>$pagination, "members"=>$members));
        }
        return new JsonResponse(array('message'=>"You aren't a member."));
    }


     /**
     * @Route("/favorites/members/add")
     * @Rest\Get("/favorites/members/add")
     * @ApiDoc(
     *  section = "Favorite Members",
     *  description="Add a new member to favorite list ",
     *  requirements={
     *      {
     *          "name"="member",
     *          "dataType"="string",
     *          "description"=" Member Id provided in Group members api call"
     *      },
     *              }
     * )
     */
      public function addMemberFavouriteAction()
        {
         $request = $this->getRequest();
         $_member = $request->get('member',NULL);
          if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
         $array["user"]=$user;
         $em = $this->getDoctrine()->getEntityManager();
         $member = $em->getRepository("AppBundle:Member")->find($_member);
         if ($member==null){
              return new JsonResponse(array('message'=>"This is an invalid member."));
         }
         $array["member"]=$member;
         
         $response = $em->getRepository("AppBundle:FavouriteMember")->addFavorite($array);
         return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You aren't a valid user."));

    }

     /**
     * @Route("/favorites/members/remove")
     * @Rest\Get("/favorites/members/remove")
     * @ApiDoc(
     *  section = "Favorite Members",
     *  description="(OK) Remove a member from the Favorite List ",
     *  requirements={
     *      {
     *          "name"="member",
     *          "dataType"="string",
     *          "description"=" User Id provided in member's list"
     *      },
     *              }
     * )
     */
      public function removeMemberAction()
        {
         $request = $this->getRequest();
         $_member = $request->get('member',NULL);
          if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
         $array["user"]=$user;
         $em = $this->getDoctrine()->getEntityManager();
         $member = $em->getRepository("AppBundle:Member")->find($_member);
         if ($member==null){
              return new JsonResponse(array('message'=>"This is an invalid member."));
         }
         $array["member"]=$member;
         
         $response = $em->getRepository("AppBundle:FavouriteMember")->removeFavorite($array);
         return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You haven't permissions to assist this event."));

     
       }
}