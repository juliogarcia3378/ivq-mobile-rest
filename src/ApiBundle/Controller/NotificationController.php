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
