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
use AppBundle\Entity\Follow;



class MemberController extends FOSRestController
{



   
    /**
     * @Route("/member/follow")
     * @Rest\Get("/member/follow")
     * @ApiDoc(
     *  section = "Member",
     *  description="Follow another member",
     *  requirements={
     *      {
     *          "name"="idMember",
     *          "dataType"="string",
     *          "description"="idMember for /ivq/group/members api call "
     *      },
     *  },
     * )
     */
      public function followMemberAction(){
       $request = $this->getRequest();
       $member = $request->get('idMember',NULL);
       if ($member=='')
       {
       	 return new JsonResponse(array(
                                    'error'=>"The member ID is null.",
                                    ), Response::HTTP_OK);
       }
     if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                $em = $this->getDoctrine()->getEntityManager();
               $following = array();
               $member= $em->getRepository("AppBundle:Member")->find($member);
                if ($member==null)
               {
					 return new JsonResponse(array(
                                    'error'=>"This member doesn't exist.",
                                    ), Response::HTTP_OK);
               }

               if (!$em->getRepository("AppBundle:Groups")->isMember(array('group'=>$member->getGroups()->getId(),'user'=>$user->getId())
               	)){
               	   return new JsonResponse(array(
                                    'error'=>"You haven't access to this group.",
                                    ), Response::HTTP_OK);
               }
                if ($member->getUser()->getId()==$user->getId())
               {
					 return new JsonResponse(array(
                                    'error'=>"You are trying to follow you.",
                                    ), Response::HTTP_OK);
               }

               //ask if i am following this user
                $array["following"]= $member->getUser()->getId();
                $array["follower"] =  $user->getId();
                $following = $em->getRepository("AppBundle:Follow")->isFollower($array);

                if ($following==true){
                	 return new JsonResponse(array(
                                    'message'=>"You are already following this member.",
                                    ), Response::HTTP_OK);
                }else{
                    $follow = new Follow();
                    $follow->setFollowing($member->getUser());
                    $follow->setFollower($user);
                    $em->persist($follow);
                    $em->flush();

                    return new JsonResponse(array(
                                    'message'=>"You are now following this member" ,
                                    ), Response::HTTP_OK);

                } 
            }
            return new JsonResponse(array(
                                    'error' => '301',
                                    'message'=>"You haven't permissions for this requirement" ,
                                    ), Response::HTTP_OK);
      }

     
      /**
     * @Route("/member/unfollow")
     * @Rest\Get("/member/unfollow")
     * @ApiDoc(
     *  section = "Member",
     *  description="Unfollow another member",
     *  requirements={
     *      {
     *          "name"="idFollowing",
     *          "dataType"="string",
     *          "description"="idFollowing is the id parameter provided in /ivq/profile/following api call "
     *      },
     *  },
     * )
     */
      public function unfollowMemberAction(){
       $request = $this->getRequest();
       $following = $request->get('idFollowing',NULL);
       if ($following=='')
       {
       	 return new JsonResponse(array(
                                    'error'=>"The member ID is null.",
                                    ), Response::HTTP_OK);
       }
     if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                $em = $this->getDoctrine()->getEntityManager();
               
               $following= $em->getRepository("AppBundle:User")->find($following);
                if ($following==null)
               {
					 return new JsonResponse(array(
                                    'error'=>"You are not following this member.",
                                    ), Response::HTTP_OK);
               }


                if ($following->getId()==$user->getId())
               {
					 return new JsonResponse(array(
                                    'error'=>"You are trying to unfollow you.",
                                    ), Response::HTTP_OK);
               }

                $array["following"]= $following->getId();
                $array["follower"] =  $user->getId();
                $isFollower = $em->getRepository("AppBundle:Follow")->isFollower($array);

                if ($isFollower==false){
                	 return new JsonResponse(array(
                                    'message'=>"You aren't following this member.",
                                    ), Response::HTTP_OK);
                }else{
                    $em->remove($following);
                    $em->flush();

                    return new JsonResponse(array(
                                    'message'=>"You are not longer a follower to this member." ,
                                    ), Response::HTTP_OK);

                } 
            }
            return new JsonResponse(array(
                                    'error' => '301',
                                    'message'=>"You haven't permissions for this requirement." ,
                                    ), Response::HTTP_OK);
      }

     
 }