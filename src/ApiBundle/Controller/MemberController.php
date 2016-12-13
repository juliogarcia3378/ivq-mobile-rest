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
use AppBundle\Entity\Notification;
use Core\ComunBundle\Enums\ENotification;



class MemberController extends FOSRestController
{

 
    /**
     * @Route("/member/profile")
     * @Rest\Get("/member/profile")
     * @ApiDoc(
     *  section = "Member",
     *  description="Member Profile",
     *  requirements={
     *      {
     *          "name"="idMember",
     *          "dataType"="string",
     *          "description"="idMember for /ivq/group/members api call "
     *      },
     *  },
     * )
     */
      public function memberProfileAction(){
       $request = $this->getRequest();
       $idMember = $request->get('idMember',NULL);
       if ($idMember=='')
       {
         return new JsonResponse(array(
                                    'error'=>"The member ID is null.",
                                    ), Response::HTTP_OK);
       }
         $em = $this->getDoctrine()->getEntityManager();
         $member = $em->getRepository("AppBundle:Member")->find($idMember);
            if ($member==null)
              {
               return new JsonResponse(array(
                                    'error'=>"This is not a valid member.",
                                    ), Response::HTTP_OK);
              }
                     $response = array();
                        $response['id']=$member->getId();
                        if ($member->getUser()->getProfile()!=null){
                        $response['avatar']=$member->getUser()->getProfile()->getAvatar()->getURL();
                        $response['logo']=$member->getGroups()->getLogo()->getURL();
                        $response['address']=$member->getUser()->getProfile()->getAddress()->getCityAndState();
                        $response['name']=$member->getUser()->getProfile()->getFullName();
                         $groups=$em->getRepository('AppBundle:Groups')->byMemberSubscribed(array('user'=>$member->getUser()->getId()));
                        $response['groups']=$groups;
                        $followers = $member->getFollowing();
                        $response["total_followers"]=count($followers);
                        $response["businessCard"]=array();
                        $response["bcards"]=array();
                        $response["followers"]=array();
                        foreach ($followers as $key => $follower) {
                          $aux["id"]=$follower->getFollower()->getId();
                          $aux["idMember"]=$follower->getFollower()->getId();
                          $aux["avatar"]=$follower->getFollower()->getUser()->getProfile()->getAvatar()->getURL();
                          $aux["name"]=$follower->getFollower()->getUser()->getProfile()->getFullName();
                          $response["followers"][]=$aux;
                        }
                       

                        $bcs = $member->getUser()->getBusinessCard();
                        foreach ($bcs as $key => $bc) {
                           if ($bc->getFinished()==false){
                            continue;
                           }
                          $aux=array();
                          $aux["id"]=$bc->getId();
                          $aux["logo"]=$bc->getLogo()->getURL();
                          $aux["title"]=$bc->getTitle();
                          $aux["name"]=$bc->getName();
                          $aux["lastname"]=$bc->getLastname();
                          $aux["fax"]=$bc->getFax();
                          $aux["phone"]=$bc->getPhone();
                          $aux["picture"]=$bc->getPicture()->getURL();
                          $aux["category"]=$bc->getCategory()->getName();

                          if ($bc->getAddress()!=null)
                          $aux["address"]=$bc->getAddress()->getCityAndState();
                          else
                            $aux["address"]="";
                          $medias=$bc->getBusinessCardMedia();

                            $format["video"]=array();
                            $format["picture"]=array();

                          foreach ($medias as $key => $media) {
                              $arr = array();

                              $arr['id']=$media->getMedia()->getId();
                              $arr['url']=$media->getMedia()->getURL();
                                if ($media->getMedia()->getFormat()=='video'){
                                  $format["video"][]=$arr;
                                }
                                if ($media->getMedia()->getFormat()=='picture'){
                                  $format["picture"][]=$arr;

                                  }

                                  $aux["media"]=$format;
                                }



                          $response["businessCard"][]=$aux;
                          $response["bcards"][]=$aux;
                        }
                        

                        }
                       
                       //  $response[]=$array;
                    return new JsonResponse(array("profile"=>$response));



         
      }

   
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
                    $follow->setFollowing($member);
                    $idFollower = $em->getRepository("AppBundle:Member")->returnMemberID(array('group'=>$member->getGroups()->getId(),'user'=>$user->getId()));
                    

                    $userMember = $em->getRepository("AppBundle:Member")->find($idFollower);
                    $follow->setFollower($userMember);
                    $em->persist($follow);


                      
                    $notification = new Notification();
                    $notification->setMember($member);
                    $notification->setPicture(null);
                    $notification->setOtherMember($userMember);
                    $notification->setNotificationType($em->getRepository("AppBundle:NotificationType")->find(ENotification::STARTED_FOLLOWING_YOU));


                    $em->persist($notification);
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
     *          "name"="idMember",
     *          "dataType"="string",
     *          "description"="idMember is the id parameter provided in /members api call "
     *      },
     *  },
     * )
     */
      public function unfollowMemberAction(){
       $request = $this->getRequest();
       $following = $request->get('idMember',NULL);
       if ($following=='')
       {
       	 return new JsonResponse(array(
                                    'error'=>"The member ID is null.",
                                    ), Response::HTTP_OK);
       }
     if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                $em = $this->getDoctrine()->getEntityManager();
               
               $following= $em->getRepository("AppBundle:Member")->find($following);
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

                $array["following"]= $following->getUser()->getId();
                $array["follower"] =  $user->getId();
                $isFollower = $em->getRepository("AppBundle:Follow")->isFollower($array);

                if ($isFollower==false){
                	 return new JsonResponse(array(
                                    'message'=>"You aren't following this member.",
                                    ), Response::HTTP_OK);
                    }else{

                    
                    $em->getRepository("AppBundle:Follow")->unfollowMember($array);
                  

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
