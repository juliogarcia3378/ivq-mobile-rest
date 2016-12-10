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
use Core\ComunBundle\Util\UtilRepository2;



class FollowerController extends FOSRestController
{

    

    /**
     * @Route("/follower/search")
     * @Rest\Get("/follower/search")
     * @ApiDoc(
     *  section = "Profile",
     *  description="Return the list of followers by filters provided",
     *  requirements={
     *      {
     *          "name"="search",
     *          "dataType"="string",
     *          "description"="String value to search"
     *      },
     *      {
     *          "name"="start",
     *          "dataType"="string",
     *          "description"="First Element"
     *      },
     *      {
     *          "name"="limit",
     *          "dataType"="string",
     *          "description"="Total of elements requested"
     *      }
     *              }
     * )
     */
      public function searchFollowersAction()
        {
            $request = $this->getRequest();
            $em = $this->getDoctrine()->getEntityManager();
            $search = $request->get('search',NULL);
            $array["search"]=$search;
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
            $user = $this->get('security.context')->getToken()->getUser();
            $array["following"]=$user->getId();
             $followers = $em->getRepository("AppBundle:Follow")->searchFollowers($array);
             $array["search"]="";
             $total = count($em->getRepository("AppBundle:Follow")->searchFollowers($array));
              $array = array();
              $i=0;
              foreach ($followers as $key => $follow) {
                $aux["id"]=$follow->getId();
                 $aux["idMember"]=$follow->getFollower()->getId();
                    $aux["name"]=$follow->getFollower()->getUser()->getProfile()->getName();
                    $aux["lastname"]=$follow->getFollower()->getUser()->getProfile()->getLastName();
                    $aux["avatar"]=$follow->getFollower()->getUser()->getProfile()->getAvatar();
                    $followers[]=$aux;
                $array[]=$aux;
             }


            $pagination= UtilRepository2::paginate();
            return new JsonResponse(array("pagination"=>$pagination,"followers"=>$array));
        }
           
            }


     
 }
