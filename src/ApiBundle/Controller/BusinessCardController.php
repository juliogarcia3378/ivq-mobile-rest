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
use AppBundle\Entity\BusinessCard;
use AppBundle\Entity\BusinessCardMedia;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Request\Request as MyRequest;

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
                    if ($bc->getFinished()==true){
                     $bcard['id']=$bc->getId();
                     $bcard['name']=$bc->getName(). " ". $bc->getLastname();
                     $bcard['picture']=$bc->getPicture();
                     $bcard['logo']=$bc->getLogo();
                     $bcard['category']=$bc->getCategory()->getName();
                     $response[]=$bcard;}
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
                $businessCards = $anotherUser->getBusinessCard();
                $response =array();

                  foreach ($businessCards as $key => $bc) {
                    if ($bc->getFinished()==true){
                     $bcard['id']=$bc->getId();
                     $bcard['name']=$bc->getName(). " ". $bc->getLastname();
                     $bcard['picture']=$bc->getPicture();
                     $bcard['logo']=$bc->getLogo();
                     $bcard['category']=$bc->getCategory()->getName();
                     $response[]=$bcard;}
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
                if ($bc==null){
                     return new JsonResponse(array( "message"=>"Invalid Business Card. "));
                }
                if ($bc->getFinished()==false){
                     return new JsonResponse(array( "message"=>"Invalid Business Card. "));
                }
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
                     $response['company']=$bc->getCompany();
                     $response['about']=$bc->getAbout();
                     $response['logo']=$bc->getLogo();
                     $response['picture']=$bc->getPicture();
                      $medias=$bc->getBusinessCardMedia();

                            $format["video"]=array();
                            $format["picture"]=array();

                          foreach ($medias as $key => $media) {
                              $arr = array();

                              $arr['id']=$media->getId();
                              $arr['url']=$media->getURL();
                                if ($media->getFormat()=='video'){
                                  $format["video"][]=$arr;
                                }
                                if ($media->getFormat()=='picture'){
                                  $format["picture"][]=$arr;

                                  }

                                  $response["media"]=$format;
                                }
           
                return new JsonResponse(array("response"=>$response));
            }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. ")
                                   );
        }
    
    
       /**
     * @Route("/business-card/new")
     * @Rest\Get("/business-card/new")
     * @ApiDoc(
     *  section = "Business Card",
     *  description="Return the business card id",
     * )
     */
      public function newBusinessCardAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $request = $this->getRequest();
            $id = $request->get('id',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                $em = $this->getDoctrine()->getManager();

                $bc = new BusinessCard();
                $bc->setFinished(0);
                $bc->setUser($user);
                $em->persist($bc);
                $em->flush();
           
                return new JsonResponse(array("id"=>$bc->getId()));
            }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. ")
                                   );
        }


             /**
         * Set and upload avatar for reps.
         *
         * @param ParamFetcher $paramFetcher
         * @param Request $request
          * @Route("/business-card/create")
          * @Rest\Post("/business-card/create")

         * @ApiDoc(
         *  section = "Business Card",
         *      resource = true,
         *      https = true,
         *      description = "Create the business card.",

         * )
         *
        *@RequestParam(name="id", nullable=false, description="id for business card created")
        *@RequestParam(name="name", nullable=false, description="name")
        *@RequestParam(name="lastname", nullable=false, description="last name")
        *@RequestParam(name="title", nullable=false, description="title")
        *@RequestParam(name="category", nullable=false, description="Category")
        *@RequestParam(name="address", nullable=false, description="address")
        *@RequestParam(name="city", nullable=false, description="city")
        *@RequestParam(name="state", nullable=false, description="state id") 
        *@RequestParam(name="phone", nullable=false, description="phone")
        *@RequestParam(name="email", nullable=false, description="email")
        *@RequestParam(name="zip", nullable=false, description="zip")
        *@RequestParam(name="fax", nullable=true, description="fax")
        *@RequestParam(name="website", nullable=true, description="Website")
        *@RequestParam(name="notes", nullable=true, description="Notes")
        *@RequestParam(name="about", nullable=true, description="About")
        *@RequestParam(name="logo", nullable=false, description="Logo")
        *@RequestParam(name="picture", nullable=false, description="Picture")
        *@RequestParam(name="company", nullable=false, description="Company")
         *
         * @return View
         */
         
      public function createBusinessCardAction()

        {
          
 
            $request = $this->getRequest();
            $id= $request->get('id');

            $name= $request->get('name');
            $lastname= $request->get('lastname');
            $title= $request->get('title');

            $category= $request->get('category');

            $address= $request->get('address');
            $city= $request->get('city');
            $state= $request->get('state');

            $phone= $request->get('phone');
            $email= $request->get('email');

            $zip= $request->get('zip');
            $fax= $request->get('fax');

            $website= $request->get('website');
            $notes= $request->get('notes');

            $about= $request->get('about');
            $logo= $request->get('logo');
            $company= $request->get('company');


            $em = $this->getDoctrine()->getManager();

            if (!isset($name) || !isset($lastname) || !isset($category) 
                || !isset($phone) || !isset($email)  || !isset($state) || !isset($city)){
                  return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'Some mandatory fields are empty',
                        ), Response::HTTP_OK);
             }
            $bc = $em->getRepository("AppBundle:BusinessCard")->find($id);
            if ($bc==null){
                 return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The id provided is not valid',
                        ), Response::HTTP_OK);
            }
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                $bc->setName($name);
                $bc->setLastname($lastname); 
                $bc->setTitle($title);
                $bc->setCompany($company);
                
                $category =$em->getRepository("AppBundle:GroupCategory")->find($category);
               
                if ($category==null){
                     return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The category is not valid',
                        ), Response::HTTP_OK);
                }
                $bc->setCategory($category);
                $bc->setLogo($this->uploadPicture("logo",$this->getParameter('business_card_directory')));
                $bc->setPicture($this->uploadPicture("picture",$this->getParameter('business_card_directory')));
                $new_address = new Address();
                $new_address->setAddress($address);
                $new_address->setZip($zip);

                $state = $em->getRepository("AppBundle:State")->find($state);
                if ($state==null){
                     return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'The state is not valid',
                        ), Response::HTTP_OK);
                }

                $new_address->setState($state);
                $new_address->setCity($city);


                $bc->setAddress($new_address);
                $bc->setPhone($phone);
                $bc->setEmail($email);
                $bc->setFax($fax);
                $bc->setWebsite($website);
                $bc->setNotes($notes);
                $bc->setAbout($about);
                $bc->setFinished(true);

                $em->persist($bc);
                $em->flush();

               return new JsonResponse(array("message"=>'Business Card created',
                                               "id"=>$bc->getId(),
                                             )
                                        );


            }

            

            
            return new JsonResponse(array( "error"=>"You dont have permissions to change this user"
                                         )
                                   );
        }


             /**
         * Set and upload media for reps.
         *
         * @param ParamFetcher $paramFetcher
         * @param Request $request
          * @Route("/business-card/media/add")
          * @Rest\Post("/business-card/media/add")
         * @ApiDoc(
         *  section = "Business Card",
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
        *@RequestParam(name="id", nullable=false, description="The business card id")
         *
         * @return View
         */
         
      public function addMediaToBusinessCardAction()

        {
            $request = $this->getRequest();
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                if (count($_FILES)==0){
                     return new JsonResponse(array("error"=>'Error uploading the file'));
                }
                    $id= $request->get('id');
                     $em = $this->getDoctrine()->getManager();

                      $bc = $em->getRepository("AppBundle:BusinessCard")->find($id);
                            if ($bc==null){
                                 return new JsonResponse(array(
                                        'error' => '301',
                                        'message'=>'The id provided is not valid',
                                        ), Response::HTTP_OK);
                            }

                    $mybcmedia = new BusinessCardMedia();
                    $mybcmedia->setURL($this->uploadFile("media",$this->getParameter('media_directory')));
                                            if (($_FILES["media"]["type"] == "video/mp4")
                                            || ($_FILES["media"]["type"] == "video/mpeg")
                                            || ($_FILES["media"]["type"] == "audio/wmv")
                                            || ($_FILES["media"]["type"] == "video/x-ms-wmv"))
                                                $mybcmedia->setFormat("video");

                                            if (($_FILES["media"]["type"] == "image/pjpeg")
                                            || ($_FILES["media"]["type"] == "image/gif")
                                            || ($_FILES["media"]["type"] == "image/png")
                                            || ($_FILES["media"]["type"] == "image/jpeg"))  
                                                $mybcmedia->setFormat("picture");

                                         $bc->addBusinessCardMedia($mybcmedia);
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($bc);
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
