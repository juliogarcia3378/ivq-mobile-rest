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
                    $arr['id']=$media->getId();
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
                    $arr['id']=$user->getProfile()->getAvatar()->getId();
                    $arr['url']=$user->getProfile()->getAvatar()->getURL();
                        $response["picture"][]=$arr;
                }

                //media for businness-card
                 $businessCards = $user->getBusinessCard();
                //$response =array();

                  foreach ($businessCards as $key => $bc) {
                    if ($bc->getFinished()==true){
                    
                    $arr = array();
                    $arr['id']=$bc->getId();
                    $arr['url']=$bc->getPicture()->getURL();
                    $response["picture"][]=$arr;

                    $arr['id']=$bc->getLogo()->getId();
                    $arr['url']=$bc->getLogo()->getURL();
                    $response["picture"][]=$arr;
                    $medias = $bc->getBusinessCardMedia();
                      foreach ($medias as $key => $media) {
                              $arr = array();

                              $arr['id']=$media->getMedia()->getId();
                              $arr['url']=$media->getMedia()->getURL();
                                if ($media->getMedia()->getFormat()=='video')
                                  $response["video"][]=$arr;
                                if ($media->getMedia()->getFormat()=='picture')
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

            
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();

                $em = $this->getDoctrine()->getEntityManager();
                $mymedia = $em->getRepository("AppBundle:Media")->find($id);
                $em->remove($mymedia);
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

               $myMembership= $em->getRepository("AppBundle:Member")->returnMemberID(array('user'=>$user->getId(),'group'=>$event->getGroups()->getId()));
               if ($myMembership==null)
                  return new JsonResponse(array( "error"=>"You aren't a member in this group"));
            
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
                    $notification->setEvent($event);
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

