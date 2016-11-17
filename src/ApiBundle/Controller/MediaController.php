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
use AppBundle\Entity\Address;
use AppBundle\Entity\Country;
use AppBundle\Entity\State;
use AppBundle\Entity\Media;
use AppBundle\Entity\MediaEvent;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Request\Request as MyRequest;

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
                $response["video"]='';
                $response["picture"]='';
                foreach ($media as $key => $media) {
                    $arr = array();

                    $arr['id']=$media->getId();
                    $arr['url']=$media->getURL();
                      if ($media->getFormat()=='video'){
                        $response["video"][]=$arr;
                      }
                      if ($media->getFormat()=='picture'){
                        $response["picture"][]=$arr;
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
                                            if (($_FILES["media"]["type"] == "video/mp4")
                                            || ($_FILES["media"]["type"] == "video/mpeg")
                                            || ($_FILES["media"]["type"] == "audio/wmv")
                                            || ($_FILES["media"]["type"] == "video/x-ms-wmv"))
                                                $mymedia->setFormat("video");

                                            if (($_FILES["media"]["type"] == "image/pjpeg")
                                            || ($_FILES["media"]["type"] == "image/gif")
                                            || ($_FILES["media"]["type"] == "image/png")
                                            || ($_FILES["media"]["type"] == "image/jpeg"))  
                                                $mymedia->setFormat("picture");
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
            $mymedia= $em->getRepository("AppBundle:Media")->find($id);
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
                                            if (($_FILES["media"]["type"] == "video/mp4")
                                            || ($_FILES["media"]["type"] == "video/mpeg")
                                            || ($_FILES["media"]["type"] == "audio/wmv")
                                            || ($_FILES["media"]["type"] == "video/x-ms-wmv"))
                                                $mymedia->setFormat("video");

                                            if (($_FILES["media"]["type"] == "image/pjpeg")
                                            || ($_FILES["media"]["type"] == "image/gif")
                                            || ($_FILES["media"]["type"] == "image/png")
                                            || ($_FILES["media"]["type"] == "image/jpeg"))  
                                                $mymedia->setFormat("picture");
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
            $em->flush();

                return new JsonResponse(array("msg"=>'Media added',
                                             )
                                        );
            }
            
            return new JsonResponse(array( "error"=>"You dont have permissions upload media"
                                         )
                                   );
        }


 }
