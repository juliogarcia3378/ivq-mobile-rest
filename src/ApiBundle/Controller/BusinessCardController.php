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

class BusinessCardController extends FOSRestController
{


     /**
     * @Route("/me/business-card/list")
     * @Rest\Get("/me/business-card/list")
     * @ApiDoc(
     *  section = "Business Card",
     *  description="Returns the business cards ids for user's logged",

     * )
     */
      public function listMyBusinessCardAction()
        {
        	$user = $this->get('security.context')->getToken()->getUser();
            $profile = $user->getProfile();

	        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
	    	{

                $businessCards = $user->getBusinessCard();
                $response =array();

                  foreach ($businessCards as $key => $bc) {
                     $response['id']=$bc->getId();
                   
                  }
           
	            return new JsonResponse(array("response"=>$response));
	        }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. ")
                                   );
        }
      

       /**
     * @Route("/business-card/list")
     * @Rest\Get("/business-card/list")
     * @ApiDoc(
     *  section = "Business Card",
     *  description="Returns the business cards ids for user provided",
        *  requirements={
     *      {
     *          "name"="id_user",
     *          "dataType"="string",
     *          "description"=" List the business card by user id"
     *      }
           }

     * )
     */
      public function listBusinessCardAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $request = $this->getRequest();
            $profile = $user->getProfile();
            $idUser = $request->get('id_user',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $anotherUser = $em->getRepository("AppBundle:User")->find($idUser);
                 if (!isset($anotherUser))
                 {
                    return new JsonResponse(array( "message"=>"This is a invalid user."));  
                 }
                $businessCards = $user->getBusinessCard();
                $response =array();

                  foreach ($businessCards as $key => $bc) {
                     $response['id']=$bc->getId();
                  }
           
                return new JsonResponse(array("response"=>$response));
            }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. ")
                                   );
        }
    


       /**
     * @Route("/business-card/view")
     * @Rest\Get("/business-card/view")
     * @ApiDoc(
     *  section = "Business Card",
     *  description="Return the business card provided",
        *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
     *          "description"="Return the business card provided"
     *      }
           }

     * )
     */
      public function viewBusinessCardAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $request = $this->getRequest();
            $id = $request->get('id',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                $em = $this->getDoctrine()->getEntityManager();

                $bc = $em->getRepository("AppBundle:BusinessCard")->find($id);
                $response =array();

                     $response['id']=$bc->getId();
                     $response['name']=$bc->getName();
                     $response['lastname']=$bc->getLastname();
                     $response['title']=$bc->getTitle();
                     $response['category']=$bc->getCategory()->getName();
                     $response['address']["state"]=$bc->getAddress()->getState()->getName();
                     $response['address']["zip"]=$bc->getAddress()->getZip();
                     $response['address']["city"]=$bc->getAddress()->getCity();
                     $response['phone']=$bc->getPhone();
                     $response['email']=$bc->getEmail();
                     $response['fax']=$bc->getFax();
                     $response['website']=$bc->getWebsite();
                     $response['notes']=$bc->getNotes();
                     $response['about']=$bc->getAbout();
                     $response['logo']=$bc->getLogo();
                     $response['picture']=$bc->getPicture();
           
                return new JsonResponse(array("response"=>$response));
            }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. ")
                                   );
        }
    


 }