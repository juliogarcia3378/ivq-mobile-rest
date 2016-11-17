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
use AppBundle\Entity\Coupon;
use FOS\RestBundle\Controller\Annotations\RequestParam;
use FOS\RestBundle\Request\ParamFetcher;
use FOS\RestBundle\Request\Request as MyRequest;

class CouponController extends FOSRestController
{



       /**
     * @Route("/coupon/list")
     * @Rest\Get("/coupon/list")
     * @ApiDoc(
     *  section = "Coupons and Surveys",
     *  description="Returns the coupons for group provided",
        *  requirements={
     *      {
     *          "name"="group",
     *          "dataType"="string",
     *          "description"=" List the coupons by group id"
     *      }
           }

     * )
     */
      public function listCouponsAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $request = $this->getRequest();
            $profile = $user->getProfile();
            $idGroup = $request->get('group',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                $em = $this->getDoctrine()->getEntityManager();
                $group = $em->getRepository("AppBundle:Groups")->find($idGroup);
                 if (!isset($group))
                 {
                    return new JsonResponse(array( "message"=>"This is a invalid group."));  
                 }
                $coupons = $group->getCoupon();
                $response =array();

                  foreach ($coupons as $key => $coupon) {
                     $array['id']=$coupon->getId();
                     $array['logo']=$coupon->getLogo();
                     $array['name']=$coupon->getName();
                     $array['information']=$coupon->getInformation();
                     $array['expiration']=$coupon->getExpiresAt();
                     $response[]=$array;
                  }
           
                return new JsonResponse(array("response"=>$response));
            }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. ")
                                   );
        }
    


       /**
     * @Route("/coupon/view")
     * @Rest\Get("/coupon/view")
     * @ApiDoc(
     *  section = "Coupons and Surveys",
     *  description="View coupon",
        *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
     *          "description"="Return the coupon by id provided"
     *      }
           }

     * )
     */
      public function viewCouponAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $request = $this->getRequest();
            $id = $request->get('id',NULL);
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE ||
             $this->get('security.context')->isGranted('ROLE_ADVERTISER')  === TRUE) 
            {
                $em = $this->getDoctrine()->getEntityManager();

                $coupon = $em->getRepository("AppBundle:Coupon")->find($id);
                if ($coupon==null){
                     return new JsonResponse(array( "error"=>"Invalid Coupon. "));
                }


                     $array['id']=$coupon->getId();
                     $array['logo']=$coupon->getLogo();
                     $array['barcode']=$coupon->getBarcode();
                     $array['code']=$coupon->getCode();
                     $array['name']=$coupon->getName();
                     $array['information']=$coupon->getInformation();
                     $array['expiration']=$coupon->getExpiresAt();
           
                return new JsonResponse(array("response"=>$array));
            }

            return new JsonResponse(array( "message"=>"You dont have enough permissions. ")
                                   );
        }
    

 }