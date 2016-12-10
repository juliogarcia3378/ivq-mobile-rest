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
use Core\ComunBundle\Util\UtilRepository2;
use FOS\RestBundle\Request\Request as MyRequest;

class CommentController extends FOSRestController
{


    /**
     * @Route("/comments/list")
     * @Rest\Get("/comments/list")
     * @ApiDoc(
     *  section = "Comments and Like Section",
     *  description="List Comments by Media",
     *  requirements={
     *      {
     *          "name"="idMedia",
     *          "dataType"="string",
     *          "description"="IdMedia for /app/event/media/list api call "
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
     *  },
     * )
     */
      public function listCommentsByMediaAction()
        {
        	 $request = $this->getRequest();
             $id = $request->get('idMedia');
            
            if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
                $user = $this->get('security.context')->getToken()->getUser();
               
            $em = $this->getDoctrine()->getEntityManager();
            $mediaEvent= $em->getRepository("AppBundle:MediaEvent")->find($id);
                if ($mediaEvent ==null)
	           return new JsonResponse(array( "error"=>"This media event is not valid."
                                   ));
             $array["idMedia"]=$id;
             $array["start"]=$this->getRequest()->get("start");
             $array["limit"]=$this->getRequest()->get("limit");
             $comments = $em->getRepository("AppBundle:Comment")->byMediaEvent($array);

             //   usort($response, "sortFunction");
            $pagination= UtilRepository2::paginate();
            return new JsonResponse(array("pagination"=>$pagination,"comments"=>$comments));

	        }
              
            return new JsonResponse(array( "error"=>"You dont have permissions."
                                   ));
        }
             /**
         * Set and upload avatar for reps.
         *
         * @param ParamFetcher $paramFetcher
         * @param Request $request
          * @Route("/comment/add")
          * @Rest\Post("/comment/add")
         * @ApiDoc(
         *  section = "Comments and Like Section",
         *  description="add Comment",
         *      resource = true,
         *      https = true,
         * )
         *
        *@RequestParam(name="idMedia", nullable=false, description="IdMedia for /app/event/media/list api call")
        *@RequestParam(name="comment", nullable=false, description="Comment") 
         *
         * @return View
         */

            public function addCommentAction()
        {
         $request = $this->getRequest();
         $idMedia = $request->get('idMedia',NULL);
         $comment = $request->get('comment',NULL);
         if ($comment==null){
            return new JsonResponse(array( "error"=>"You should write a comment."
                                   ));
         }
          if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
            $user = $this->get('security.context')->getToken()->getUser();
          
            $em = $this->getDoctrine()->getEntityManager();
            $mediaEvent= $em->getRepository("AppBundle:MediaEvent")->find($idMedia);
            if ($mediaEvent ==null)
              return new JsonResponse(array( "error"=>"This media event is not valid."
                                   ));    
         $array["user"]=$user;
         $array["comment"]=$comment;
         $array["mediaEvent"]=$mediaEvent;
         
         $response = $em->getRepository("AppBundle:Comment")->addComment($array);
         return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You haven't permissions to write a comment."));

    }

                 /**
     * @Route("/media-attached/like")
     * @Rest\Get("/media-attached/like")
     * @ApiDoc(
     *  section = "Comments and Like Section",
     *  description="Like a media attached",
     *  requirements={
     *      {
     *          "name"="idMedia",
     *          "dataType"="string",
                "description"="IdMedia for /app/event/media/list api call "
     *      }
     *              }
     * )
     */
      public function addLiketoMediaAction()
        {
       $request = $this->getRequest();
         $idMedia = $request->get('idMedia',NULL);
          if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
             $user = $this->get('security.context')->getToken()->getUser();
              
         $array["user"]=$user;
         $em = $this->getDoctrine()->getEntityManager();
         $media = $em->getRepository("AppBundle:MediaEvent")->find($idMedia);
         if ($media==null){
              return new JsonResponse(array('message'=>"This is an invalid media."));
         }
         $array["media"]=$media;
         
         $response = $em->getRepository("AppBundle:MediaEvent")->like($array);
         return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You haven't permissions to assist this event."));


    }
      

    
     

 }
