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
	            return new JsonResponse(array("msg"=>'ok',
	            							   "role"=>'ROLE_MEMBER',
	            							   "userId"=>$user->getId()
	            							 )
	            						);
	        }
                        if ($this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                return new JsonResponse(array("msg"=>'ok',
                                               "role"=>'ROLE_MEMBER',
                                               "userId"=>$user->getId()
                                             )
                                        );
            }
            return new JsonResponse(array( "userId"=>$user->getId()
                                         )
                                   );
        }
 }