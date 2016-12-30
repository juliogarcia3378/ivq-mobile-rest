<?php

namespace ApiBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use AppBundle\Entity\Notification;
use FOS\RestBundle\Request\Request as MyRequest;
use AppBundle\Entity\Profile;
use AppBundle\Entity\Address;
use AppBundle\Entity\Country;
use AppBundle\Entity\State;
use AppBundle\Entity\BusinessCard;
use AppBundle\Entity\BusinessCardMedia;
use AppBundle\Entity\Media;
use Core\ComunBundle\Enums\EMedia;

class NotificationController extends FOSRestController
{


     /**
     * @Route("/notification/list")
     * @Rest\Get("/notification/list")
     * @ApiDoc(
     *  section = "Notifications",
     *  description="Return the user's notifications",

     * )
     */
      public function myNotificationsAction()
        {
        	$user = $this->get('security.context')->getToken()->getUser();
	        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) 
	    	{
                $em = $this->getDoctrine()->getManager();
                $notifications = $em->getRepository("AppBundle:Notification")->byUser(array('user'=>$user->getId()));
                $response =array();
                $response['msg']='ok';
                $response['notifications']=$notifications;
	            return new JsonResponse($response);
	        }
             return new JsonResponse(array('error'=>"You haven't permissions to see this functionality"));
                         
           
        }
      

     /**
     * @Route("/notification/delete")
     * @Rest\Get("/notification/delete")
     * @ApiDoc(
     *  section = "Notifications",
     *  description="Remove the notification by id provided",
          *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
     *          "description"="Id for notification"
     *      }
     *                     }
     * )
     */
      public function deleteNotificationAction()
        {
            $request = $this->getRequest();
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('id',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) 
            {
             $user = $this->get('security.context')->getToken()->getUser();
             $notification = $em->getRepository("AppBundle:Notification")->find($id);
             if ($notification==null)
                return new JsonResponse(array('error'=>"The id provided is invalid"));
             
             if ($notification->getMember()->getUser()->getId()!=$user->getId())
                return new JsonResponse(array('error'=>"The id provided is invalid"));
                 $em->remove($notification);
                 $em->flush();

             return new JsonResponse(array("msg"=>"The notification has been deleted sucesfully"));
             }
            return new JsonResponse(array('error'=>"You haven't permissions to access this functionality"));
                         
           
            }

     /**
     * @Route("/notification/confirm")
     * @Rest\Get("/notification/confirm")
     * @ApiDoc(
     *  section = "Notifications",
     *  description="Confirm the notification by id provided",
          *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
     *          "description"="Id for notification"
     *      }
     *                     }
     * )
     */
      public function confirmNotificationAction()
        {
            $request = $this->getRequest();
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('id',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) 
            {
             $user = $this->get('security.context')->getToken()->getUser();
             $notification = $em->getRepository("AppBundle:Notification")->find($id);
             if ($notification==null)
                return new JsonResponse(array('error'=>"The id provided is invalid"));
             
             if ($notification->getMember()->getUser()->getId()!=$user->getId())
                return new JsonResponse(array('error'=>"The id provided is invalid"));
              $bc = $notification->getBusinessCard();
            if ($bc==null)
                return new JsonResponse(array( "message"=>"Only for business card"));

                 
                 $new_bcard = new BusinessCard();
                 $new_bcard->setName($bc->getName());
                 $new_bcard->setLastname($bc->getLastname()); 
                 $new_bcard->setTitle($bc->getTitle());
                 $new_bcard->setCompany($bc->getCompany());
                 $new_bcard->setCategory($bc->getCategory());
                 $new_bcard->setCompany($bc->getCompany());
                 $new_bcard->setPhone($bc->getPhone());
                 $new_bcard->setEmail($bc->getEmail());
                 $new_bcard->setFax($bc->getFax());
                 $new_bcard->setWebsite($bc->getWebsite());
                 $new_bcard->setNotes($bc->getNotes());
                 $new_bcard->setAbout($bc->getAbout());
                 $new_bcard->setFinished($bc->getFinished());
                 $new_bcard->setSaved(true);
                 $new_bcard->setUser($user);
                 
                 $new_picture = $this->copyFile($bc->getPicture()->getURL());
                 $media = new Media();
                 $media->setURL($new_picture);
                 $media->setFormat($bc->getPicture()->getFormat());
                 $new_bcard->setPicture($media);
                 

                 $new_logo = $this->copyFile($bc->getLogo());
                 $media = new Media();
                 $media->setURL($new_logo);
                 $media->setFormat($bc->getLogo()->getFormat());
                 $new_bcard->setLogo($media);


                 $new_address = new Address();
                 $new_address->setState($bc->getAddress()->getState());
                 $new_address->setAddress($bc->getAddress()->getAddress());
                 $new_address->setZip($bc->getAddress()->getZip());
                 $new_address->setCity($bc->getAddress()->getCity());

                 $em->persist($new_address);
                 $new_bcard->setAddress($new_address);

                 $em->persist($new_bcard);
                  $em->remove($notification);
                 $em->flush();
                 return new JsonResponse(array( "message"=>"Operation Sucesfully"));
            }
            return new JsonResponse(array('error'=>"You haven't permissions to access this functionality"));
                         
           
            }

     /**
     * @Route("/notification/clear")
     * @Rest\Get("/notification/clear")
     * @ApiDoc(
     *  section = "Notifications",
     *  description="Remove all user's notifications",
     * )
     */
      public function deleteAllNotificationAction()
        {
            $request = $this->getRequest();
            $em = $this->getDoctrine()->getManager();
            $id = $request->get('id',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) 
            {
             $user = $this->get('security.context')->getToken()->getUser();
             $notifications = $em->getRepository("AppBundle:Notification")->byUser(array('user'=>$user->getId()));

             foreach ($notifications as $key => $ntf) {
                $em->remove($em->getRepository("AppBundle:Notification")->find($ntf["id"]));
             }
                 
                 $em->flush();

             return new JsonResponse(array("msg"=>"All notifications has been deleted sucesfully"));
             }
            return new JsonResponse(array('error'=>"You haven't permissions to access this functionality"));
                         
           
            }

 }
