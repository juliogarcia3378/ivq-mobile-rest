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
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Request\Request as MyRequest;

class ProfileController extends FOSRestController
{


     /**
     * @Route("/profile")
     * @Rest\Get("/profile")
     * @ApiDoc(
     *  section = "Profile",
     *  description="Returns the current user's profile",

     * )
     */
      public function profileAction()
        {
        	$user = $this->get('security.context')->getToken()->getUser();
            $profile = $user->getProfile();
            $followers=0;
	    	if ($this->get('security.context')->isGranted('ROLE_ADMIN')  === TRUE) 
	    	{
                $response = array("msg"=>'ok',
                                               "role"=>'ROLE_ADMIN',
                                               "userId"=>$user->getId());
                if ($profile==null){
                    $response["profile"]["phone"]="";
                    $response["profile"]["name"]="";
                    $response["profile"]["avatar"]="";
                }else
                {
                    $response["profile"]["phone"]=$profile->getPhone();
                    $response["profile"]["name"]=$profile->getName();
                    $response["profile"]["avatar"]=$profile->getAvatar()->getURL();
                }

	            return new JsonResponse($response);
	        }
	        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) 
	    	{
                $memberships=$user->getMembers();
                foreach ($memberships as $key => $membership) {
                    foreach ($membership->getFollowing() as $key => $following) {
                    $followers = $followers + count($following->getFollower());
                    }
                }
                
                $response =array();
                $response['msg']='ok';
                $response['role']='ROLE_MEMBER';
                $response['total_followers']=$followers;
                $response['userId']=$user->getId();
                if ($profile!=null){
                    $response['profile']['phone']=$profile->getPhone();
                    $response['profile']['name']=$profile->getName();
                    $response['profile']['lastname']=$profile->getLastname();
                    if ($profile->getAvatar()!=null)
                        $response['profile']['avatar']=$profile->getAvatar()->getURL();
                    else
                        $response['profile']['avatar']="";
                    if ($profile->getAddress()!=null){
                        $response['profile']['city']=$profile->getAddress()->getCity();
                        $response['profile']['state']=$profile->getAddress()->getState()->getName();
                    }else
                    {
                        $response['profile']['city']="";
                        $response['profile']['state']="";
                    }
                }
	            return new JsonResponse($response);
	        }
                        if ($this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                return new JsonResponse(array("msg"=>'ok',
                                               "role"=>'ROLE_MEMBER',
                                               "userId"=>$user->getId(),
                                              'profile'=>array(
                                                    'name'=>$profile->getName(),
                                                    'avatar'=>$profile->getAvatar()->getURL()
                                             ))
                                        );
            }
            return new JsonResponse(array( "userId"=>$user->getId()
                                         )
                                   );
        }
      

     /**
     * @Route("/profile/following")
     * @Rest\Get("/profile/following")
     * @ApiDoc(
     *  section = "Profile",
     *  description="Get the another members I am following",
     *  requirements={
     *              }
     * )
     */
      public function getFollowingAction(){

  if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
               $following = array();
               $members= $user->getMembers();

               foreach ($members as $key => $member) {
               foreach ($member->getFollower() as $key => $follower) {
                    $aux["idMember"]=$follower->getFollowing()->getId();
                    $profile = $follower->getFollowing()->getUser()->getProfile();
                    if ($profile!=null){
                    $aux["name"]=$profile->getName();
                    $aux["lastname"]=$profile->getLastName();
                    $aux["avatar"]=$profile->getAvatar()->getURL();
                }else{
                     $aux["name"]="";
                    $aux["lastname"]="";
                    $aux["avatar"]="";
                }
                    $following[]=$aux;
                }
                    
               }
                
            return new JsonResponse(array(
                                    'response'=>$following,
                                    ), Response::HTTP_OK);
            }
            return new JsonResponse(array(
                                    'error' => '301',
                                    'message'=>"You haven't permissions for this requirement" ,
                                    ), Response::HTTP_OK);
      }
     
    /**
     * @Route("/profile/followers")
     * @Rest\Get("/profile/followers")
     * @ApiDoc(
     *  section = "Profile",
     *  description="Get my followers",
     *  requirements={
     *              }
     * )
     */
      public function getFollowerAction(){
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
               $followers = array();
               $members= $user->getMembers();

               foreach ($members as $key => $member) {
                  
               foreach ($member->getFollowing() as $key => $following) {
                    $aux["idMember"]=$following->getFollower()->getId();
                    $profile = $following->getFollower()->getUser()->getProfile();
                    if ($profile!=null){
                    $aux["name"]=$following->getFollower()->getUser()->getProfile()->getName();
                    $aux["lastname"]=$following->getFollower()->getUser()->getProfile()->getLastName();
                    $aux["avatar"]=$following->getFollower()->getUser()->getProfile()->getAvatar()->getURL();
                     }else
                     {
                    $aux["name"]="";
                    $aux["lastname"]="";
                    $aux["avatar"]="";
                     }
                    $followers[]=$aux;
                    
               }
                 }
            return new JsonResponse(array(
                                    'response'=>$followers,
                                    ), Response::HTTP_OK);
            }
            return new JsonResponse(array(
                                    'error' => '301',
                                    'message'=>"You haven't permissions for this requirement" ,
                                    ), Response::HTTP_OK);
      }
      
    
     
             /**
         * Set and upload avatar for reps.
         *
         * @param ParamFetcher $paramFetcher
         * @param Request $request
          * @Route("/profile/update")
          * @Rest\Post("/profile/update")
         * @ApiDoc(
         *  section = "Profile",
         *      resource = true,
         *      https = true,
         *      description = "Set and upload avatar for reps.",
         *      statusCodes = {
         *          200 = "Returned when successful",
         *          400 = "Returned when errors"
         *      }
         * )
         *
        *@RequestParam(name="avatar", nullable=false, description="The avatar file")
        *@RequestParam(name="name", nullable=false, description="name")
        *@RequestParam(name="lastname", nullable=false, description="last name")
        *@RequestParam(name="city", nullable=false, description="city")
        *@RequestParam(name="state", nullable=false, description="state id") 
        *@RequestParam(name="phone", nullable=false, description="phone number") 
         *
         * @return View
         */
         
      public function updateAction()

        {

 
            $request = $this->getRequest();
            $name= $request->get('name');
            $lastname= $request->get('lastname');
            $city= $request->get('city');
            $state= $request->get('state');
            $phone= $request->get('phone');

            $em = $this->getDoctrine()->getEntityManager();

            if (!isset($name) & !isset($lastname) & !isset($avatar) ){
                  return new JsonResponse(array(
                        'error' => '301',
                        'message'=>'All fields are empty',
                        ), Response::HTTP_OK);
             }

            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
                $profile = $user->getProfile();
                  if ($profile==null)
                    {
                    $profile = new Profile();
                    $user->setProfile($profile);
		    }
                    $profile = $user->getProfile();
                    if (isset($phone))
                      $profile->setPhone($phone);
                if ($profile->getAddress()==null){
                    $address = new Address();
                     if (!isset($city) || !isset($state)){
                         return new JsonResponse(array(
                            'error' => '301',
                            'message'=>'City and State are needed for create the Profile',
                            ), Response::HTTP_OK);
                     }else {
                        if (isset($city))
                            $address->setCity($city);
                        if (isset($state))
                        {
                            $exists=$em->getRepository("AppBundle:State")->find($state);
                            if ($exists)
                                   $address->setState($exists);
                             else
                                return new JsonResponse(array(
                                    'error' => '301',
                                    'message'=>'The state provided doesnt exists',
                                    ), Response::HTTP_OK);

                        }
                     }
                     $profile->setAddress($address);
                    $em->persist($address);
                }
                else{
                    $address = $profile->getAddress();
                        if (isset($city))
                            $address->setCity($city);
                         if (isset($state))
                        {
                            $exists=$em->getRepository("AppBundle:State")->find($state);
                            if ($exists)
                                 $address->setState($exists);
                             else
                                return new JsonResponse(array(
                                    'error' => '301',
                                    'message'=>'The state provided doesnt exists',
                                    ), Response::HTTP_OK);

                        }
                }

  
      
                      if (isset($_FILES["avatar"])){
                      $file = $_FILES["avatar"]["name"];              
                         if ($file!=null){
                                     if($_SERVER['REQUEST_METHOD']=='POST'){

                        $file = $this->uploadFile("avatar",$this->getParameter('profile_directory'));
                        $format =$this->getFileType("avatar");

                        if ($profile->getAvatar()==null){
                        $media = new Media();
                        $media->setURL($file);
                        $media->setFormat($format);
                        $profile->setAvatar($media);

                        }else
                        $profile->getAvatar()->setURL($file);
                            }
                 }
             }
                   
                 if ($name!=null)
                    $profile->setName($name);
                 if ($lastname!=null)
                    $profile->setLastname($lastname);
            
            $em->persist($profile);
            $em->flush();

                return new JsonResponse(array("msg"=>'Profile updated',
                                               "role"=>'ROLE_MEMBER',
                                             )
                                        );
            }
            
            return new JsonResponse(array( "error"=>"You dont have permissions to change this user"
                                         )
                                   );
        }


 }
