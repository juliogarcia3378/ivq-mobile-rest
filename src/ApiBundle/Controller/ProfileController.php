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
	    	if ($this->get('security.context')->isGranted('ROLE_ADMIN')  === TRUE) 
	    	{
	            return new JsonResponse(array("msg"=>'ok',
	            							   "role"=>'ROLE_ADMIN',
	            							   "userId"=>$user->getId(),
	            							   'profile'=>array(
	            							   		'name'=>$profile->getName(),
	            							   		'avatar'=>$profile->getAvatar()
	            							 ))
	            						);
	        }
	        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) 
	    	{
                $response =array();
                $response['msg']='ok';
                $response['role']='ROLE_MEMBER';
                $response['userId']=$user->getId();
                $response['profile']['name']=$profile->getName();
                $response['profile']['lastname']=$profile->getLastname();
                $response['profile']['avatar']=$profile->getAvatar();
                if ($profile->getAddress()!=null){
                $response['profile']['city']=$profile->getAddress()->getCity();
                $response['profile']['state']=$profile->getAddress()->getState()->getName();
                }else
                {
                $response['profile']['city']="";
                $response['profile']['state']="";
                }


	            return new JsonResponse($response
        
	            						);
	        }
                        if ($this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                return new JsonResponse(array("msg"=>'ok',
                                               "role"=>'ROLE_MEMBER',
                                               "userId"=>$user->getId(),
                                              'profile'=>array(
                                                    'name'=>$profile->getName(),
                                                    'avatar'=>$profile->getAvatar()
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
               $members= $user->getFollower();
               foreach ($members as $key => $member) {
                    $aux["id"]=$member->getFollowing()->getId();
                    $aux["name"]=$member->getFollowing()->getProfile()->getName();
                    $aux["lastname"]=$member->getFollowing()->getProfile()->getLastName();
                  //      $aux["avatar"]=$member->getFollowing()->getProfile()->getAvatar();
                    $following["following"][]=$aux;

                    
               }
                $following["total"]=count($members);
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
               $members= $user->getFollowing();
               foreach ($members as $key => $member) {
                    $aux["id"]=$member->getFollower()->getId();
                    $aux["name"]=$member->getFollower()->getProfile()->getName();
                    $aux["lastname"]=$member->getFollower()->getProfile()->getLastName();
                    $aux["avatar"]=$member->getFollower()->getProfile()->getAvatar();
                    $followers[]=$aux;
                    
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
     * @Route("/profile/update")
     * @Rest\Get("/profile/update")
     * @ApiDoc(
     *  section = "Profile",
     *  description="Update current user's profile",
     *  requirements={
     *      {"name"="name", "dataType"="string", "require"=false, "description"="name"},
     *      {"name"="lastname", "dataType"="string", "require"=false, "description"="last name"},
     *      {"name"="avatar", "dataType"="string", "require"=false, "description"="avatar"},
     *      {"name"="city", "dataType"="string", "require"=true, "description"="city"},
     *      {"name"="state", "dataType"="numeric", "require"=true, "description"="numeric value for State *       list call"},
     *              }
     * )
     */
      public function updateAction()
        {
            $request = $this->getRequest();
            $name= $request->get('name');
            $lastname= $request->get('lastname');
            $city= $request->get('city');
            $state= $request->get('state');
            $avatar= $request->get('avatar');

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
                 if ($avatar!=null)
                    $profile->setAvatar($avatar);
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