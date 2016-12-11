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
use AppBundle\Entity\Profile;
use AppBundle\Repository\ProfileRepository;
use AppBundle\Repository\BusinessCardMediaRepository;
use AppBundle\Entity\Address;
use AppBundle\Entity\Country;
use AppBundle\Entity\State;
use AppBundle\Entity\Notification;
use AppBundle\Entity\Media;
use AppBundle\Entity\MediaEvent;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Request\Request as MyRequest;
use Core\ComunBundle\Enums\EMedia;
use Core\ComunBundle\Enums\ENotification;

class MediaController extends FOSRestController
{


     /**
     * @Route("/media")
     * @Rest\Get("/media")
     * @ApiDoc(
     *  section = "My Media",
     *  description="Returns my media",

     * )
     */
      public function mediaListAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) 
            {
                $media = $user->getMedia();
                $response =array();
                $response['msg']='ok';
                $response['userId']=$user->getId();
                $response["video"]=array();
                $response["picture"]=array();

                //my-media associated
                foreach ($media as $key => $media) {
                    $arr = array();
                    $arr['id']=EMedia::Media."_".$media->getId();
                    $arr['url']=$media->getURL();
                      if ($media->getFormat()=='video')
                        $response["video"][]=$arr;
                      if ($media->getFormat()=='picture')
                        $response["picture"][]=$arr;
                }

                //my-profile
                if ($user->getProfile()!=null)
                if ($user->getProfile()->getAvatar()!=null){
                    $arr = array();
                    $arr['id']=EMedia::Profile."_".$user->getProfile()->getId();
                    $arr['url']=$user->getProfile()->getAvatar();
                        $response["picture"][]=$arr;
                }

                //media for businness-card
                 $businessCards = $user->getBusinessCard();
                //$response =array();

                  foreach ($businessCards as $key => $bc) {
                    if ($bc->getFinished()==true){
                    
                    $arr = array();
                    $arr['id']=EMedia::BCPicture."_".$bc->getId();
                    $arr['url']=$bc->getPicture();
                    $response["picture"][]=$arr;

                    $arr['id']=EMedia::BCLogo."_".$bc->getId();
                    $arr['url']=$bc->getLogo();
                    $response["picture"][]=$arr;

                    $medias = $bc->getBusinessCardMedia();
                      foreach ($medias as $key => $media) {
                              $arr = array();

                              $arr['id']=EMedia::BCMedia."_".$media->getId();
                              $arr['url']=$media->getURL();
                                if ($media->getFormat()=='video')
                                  $response["video"][]=$arr;
                                if ($media->getFormat()=='picture')
                                  $response["picture"][]=$arr;

                                }

                    }
                  }
                
                return new JsonResponse($response);
            }
              
            return new JsonResponse(array( "error"=>"You dont have permissions."
                                   ));
        }
      

    
     
             /**
         * Set and upload media for reps.
         *
         * @param ParamFetcher $paramFetcher
         * @param Request $request
          * @Route("/media/add")
          * @Rest\Post("/media/add")
         * @ApiDoc(
         *  section = "My Media",
         *      resource = true,
         *      https = true,
         *      description = "Upload media.",
         *      statusCodes = {
         *          200 = "Returned when successful",
         *          400 = "Returned when errors"
         *      }
         * )
         *
        *@RequestParam(name="media", nullable=false, description="The media file")
         *
         * @return View
         */
         
      public function addMediaAction()

        {
            $request = $this->getRequest();
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                $profile = $user->getProfile();
                if (count($_FILES)==0){
                     return new JsonResponse(array("error"=>'Error uploading the file',
                                             )
                                        );
                }

                    $mymedia = new Media();
                    $mymedia->setURL($this->uploadFile("media",$this->getParameter('media_directory')));
                     $media=$this->getFileType();
                     if ($media==false){
                        return new JsonResponse(array( "error"=>"This format is unsupported"));
                     }
                     $mymedia->setFormat($media);

            $user->addMedia($mymedia);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($mymedia);
            $em->flush();

                return new JsonResponse(array("msg"=>'Media added',
                                             )
                                        );
            }
            
            return new JsonResponse(array( "error"=>"You dont have permissions upload media"
                                         )
                                   );
        }

    
             /**
         * Set and upload media for reps.
         *
         * @param ParamFetcher $paramFetcher
         * @param Request $request
          * @Route("/media/delete")
          * @Rest\Get("/media/delete")
         * @ApiDoc(
         *  section = "My Media",
         *  requirements={
         *      {
         *          "name"="id",
         *          "dataType"="string",
         *          "description"=" Id for Media element"
         *      },
         *              }
         * )
         *

         */
         
      public function deleteMediaAction()

        {

            $request = $this->getRequest();
             $id = $request->get('id');
             $array = explode("_", $id);
             $id=$array[1];

            
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
               
            $em = $this->getDoctrine()->getEntityManager();
            switch ($array[0]) {
                case EMedia::Media:
                  $mymedia= $em->getRepository("AppBundle:Media")->find($id);
                  if ($mymedia!=null)
                  $em->remove($mymedia);
                    break;
                case EMedia::Profile:
                 $mymedia= $em->getRepository("AppBundle:Profile")->find($id);
                 if ($mymedia!=null)
                  {
                 $mymedia->setAvatar(null);
                 $em->persist($mymedia);
                  }
                    break;
                 case EMedia::BCPicture:
                 $mymedia= $em->getRepository("AppBundle:BusinessCard")->find($id);
                 if ($mymedia!=null)
                 $em->remove($mymedia);
                    break;
                 case EMedia::BCLogo:
                 $mymedia= $em->getRepository("AppBundle:BusinessCard")->find($id);
                 if($mymedia!=null)
                 $em->remove($mymedia);
                    break;

                 case EMedia::BCMedia:
                 $mymedia= $em->getRepository("AppBundle:BusinessCardMedia")->find($id);
                 if ($mymedia!=null)
                 $em->remove($mymedia);
                    break;
                default:
                    # code...
                    break;
            }
            
            $em->flush();

                return new JsonResponse(array("msg"=>'Media removed',
                                             )
                                        );
            }
            
            return new JsonResponse(array( "error"=>"You dont have permissions to delete media"
                                         )
                                   );
        }



             /**
         * Set and upload media for reps.
         *
         * @param ParamFetcher $paramFetcher
         * @param Request $request
          * @Route("/events/media/add")
          * @Rest\Post("/events/media/add")
         * @ApiDoc(
         *  section = "Events",
         *      resource = true,
         *      https = true,
         *      description = "Upload media.",
         *      statusCodes = {
         *          200 = "Returned when successful",
         *          400 = "Returned when errors"
         *      }
         * )
         *
        *@RequestParam(name="media", nullable=false, description="The media file")
        *@RequestParam(name="comment", nullable=false, description="Comments")
        *@RequestParam(name="event", nullable=false, description="Event ID")
         *
         * @return View
         */
         
      public function addMediaToEventAction()

        {
             $em = $this->getDoctrine()->getEntityManager();
            $request = $this->getRequest();
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                $profile = $user->getProfile();
                if (count($_FILES)==0){
                     return new JsonResponse(array("error"=>'Error uploading the file'));
                }
                  $event = $request->get('event');
                  if ($event==null){
                     return new JsonResponse(array("error"=>'This event is not valid'));
                  }
                  $event= $em->getRepository('AppBundle:Event')->find($event);
                  if ($event==null){
                     return new JsonResponse(array("error"=>'This event is not valid'));
                  }

                    $mymedia = new Media();
                    $mymedia->setURL($this->uploadFile("media",$this->getParameter('media_directory')));


                     $media=$this->getFileType();
                     if ($media==false){
                        return new JsonResponse(array( "error"=>"This format is unsupported"));
                     }
                     $mymedia->setFormat($media);

                   
            
            $user->addMedia($mymedia);
            $em->persist($mymedia);
            $mediaEvent = new MediaEvent();
            $mediaEvent->setMedia($mymedia);
            $mediaEvent->setEvent($event);
            $comment = $request->get('comment');
            if ($comment!=null){
                $mediaEvent->setComment($comment);
            }

            $em->persist($mediaEvent);
            $myMembership= $em->getRepository("AppBundle:Member")->returnMemberID(array('user'=>$user->getId(),'group'=>$event->getGroups()->getId()));
            
            $myMember= $em->getRepository("AppBundle:Member")->find($myMembership);

            $attendees = $em->getRepository("AppBundle:Attendee")->byEvent(array('event'=>$event));
            foreach ($attendees as $key => $attend) {
                   $attendee = $em->getRepository("AppBundle:Member")->find($attend['idMember']);
                    if ($myMembership == $attend['idMember'])
                        continue;
                    $notification = new Notification();
                    $notification->setMember($attendee);
                    $notification->setPicture($event->getLogo());
                    $notification->setOtherMember($myMember);
                    $notification->setNotificationType($em->getRepository("AppBundle:NotificationType")->find(ENotification::ATTACHED_MEDIA_TO_YOUR_EVENT));
                    $em->persist($notification);
             }
                    $em->flush();

                return new JsonResponse(array("msg"=>'Media added'));
            }
            
            return new JsonResponse(array( "error"=>"You dont have permissions to upload media"
                                         )
                                   );
        }


 }

