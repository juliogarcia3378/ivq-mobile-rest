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
use AppBundle\Entity\Profile;
use AppBundle\Entity\InvalidAttempts;

class BroadcastController extends FOSRestController
{


     /**
     * @Route("/broadcast/list")
     * @Rest\Get("/broadcast/list")
     * @ApiDoc(
     *  section = "Broadcast",
     *  description="Return the broadcast by group provided",
     *  requirements={
     *      {
     *          "name"="group",
     *          "dataType"="string",
     *          "description"=" Search the broadcast by group ID"
     *      },
     *      {
     *          "name"="start",
     *          "dataType"="string",
     *          "description"=" First Element requested"
     *      },
     *      {
     *          "name"="limit",
     *          "dataType"="string",
     *          "description"="Total of elements requested"
     *      }
     *              }
     * )
     */
    public function broadcastListAction()
    {
        $request = $this->getRequest();
        $group = $request->get('group',NULL);
        if ($group==NULL)
        {
            return new JsonResponse(array( "message"=>"The group ID is not valid."));  
        }
        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) 
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $array["group"]=$group;
            $array["user"]=$user->getId();
            $em = $this->getDoctrine()->getEntityManager();
            $member = $em->getRepository("AppBundle:Groups")->isMember($array);
            if ($member==false)
            {
                return new JsonResponse(array( "message"=>"You haven't permissions for listing broadcasts in this group."));  
            }else{
                $array = array();
                $array["group"]=$group;
                $start = UtilRepository2::getContainer()->get('request')->get('start');
                $size = UtilRepository2::getContainer()->get('request')->get('limit');
                UtilRepository2::getSession()->set("start", $start);
                UtilRepository2::getSession()->set("limit", $size);
                $array["start"]=$start;
                $array["limit"]=$size;
                $broadcast = $em->getRepository("AppBundle:Broadcast")->listBroadcastByGroup($array);
                $pagination= UtilRepository2::paginate();
                return new JsonResponse(array("pagination"=>$pagination,"broadcasts"=>$broadcast));
            }
        }
        return new JsonResponse(array( "message"=>"You haven't permissions for listing broadcast in this group."));
    }

    /**
     * @Route("/broadcast/view")
     * @Rest\Get("/broadcast/view")
     * @ApiDoc(
     *  section = "Broadcast",
     *  description="Return the broadcast by ID provided",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
     *          "description"=" Search the broadcast by group ID"
     *      },
     *              }
     * )
     */
    public function broadcastViewAction()
    {
        $request = $this->getRequest();
        $id = $request->get('id',NULL);
        if ($id==NULL)
        {
           return new JsonResponse(array( "message"=>"The broadcast is not valid."));  
        }
        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
            $user = $this->get('security.context')->getToken()->getUser();
            $array["user"]=$user->getId();
            $array["broadcast"]=$id;
            $em = $this->getDoctrine()->getEntityManager();
            $member = $em->getRepository("AppBundle:Broadcast")->havePermissions($array);
            if ($member==false)
            {
                return new JsonResponse(array( "message"=>"You haven't permissions for view this broadcast."));  
            }else{
                $broadcast = $em->getRepository("AppBundle:Broadcast")->find($id);
                if ($broadcast==NULL)
                    return new JsonResponse(array( "message"=>"The broadcast is not valid."));  

                $array=array();
                $array["id"]  =$broadcast->getId();
                $array["url"] =$broadcast->getMedia()->getURL();
                $array["date"]=$broadcast->getDate();
                $array["title"]  =$broadcast->getName();
                $array["description"]  =$broadcast->getDescription();
                if($broadcast->getSurvey()!=null)
                     $array["survey"]= $broadcast->getSurvey()->getId();
                else
                    $array["survey"]="";
                return new JsonResponse(array("broadcast"=>$array));
            }
        }
        return new JsonResponse(array( "message"=>"You haven't permissions for view this broadcast."));
    }

    /**
     * @Route("/broadcast/like")
     * @Rest\Get("/broadcast/like")
     * @ApiDoc(
     *  section = "Broadcast",
     *  description="Like a broadcast",
     *  requirements={
     *      {
     *          "name"="id",
     *          "dataType"="string",
                "description"="broadcast Id "
     *      }
     *              }
     * )
     */
    public function addLiketoBroadcastAction()
    {
        $request = $this->getRequest();
        $id = $request->get('id',NULL);
        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
            $user = $this->get('security.context')->getToken()->getUser();
            $em = $this->getDoctrine()->getEntityManager();
            $broadcast = $em->getRepository("AppBundle:Broadcast")->find($id);
            if ($broadcast==null){
                return new JsonResponse(array('message'=>"This is an invalid broadcast."));
            }
            $array["group"]=$broadcast->getGroup()->getId();
            $array["user"]=$user->getId();

            $em = $this->getDoctrine()->getEntityManager();
            $member = $em->getRepository("AppBundle:Groups")->isMember($array);
            if ($member==false)
            {
                return new JsonResponse(array('message'=>"Please join this group to access this feature.")); 
            }
            $like["user"]=$user;
            $like["broadcast"]=$broadcast;
             $response = $em->getRepository("AppBundle:Broadcast")->like($array);
             return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You haven't permissions to access this functionality."));


    }


    /**
    * @Route("/broadcast/dislike")
    * @Rest\Get("/broadcast/dislike")
    * @ApiDoc(
    *  section = "Broadcast",
    *  description="Like a broadcast",
    *  requirements={
    *      {
    *          "name"="id",
    *          "dataType"="string",
               "description"="broadcast Id "
    *      }
    *              }
    * )
    */
    public function disLikeBroadcastAction()
    {
        $request = $this->getRequest();
        $id = $request->get('id',NULL);
        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
            $user = $this->get('security.context')->getToken()->getUser();
            $array["user"]=$user;
            $em = $this->getDoctrine()->getEntityManager();
            $broadcast = $em->getRepository("AppBundle:Broadcast")->find($id);
            if ($broadcast==null){
                return new JsonResponse(array('message'=>"This is an invalid broadcast."));
            }
            $array["broadcast"]=$broadcast;
            $response = $em->getRepository("AppBundle:Broadcast")->dislike($array);
            return new JsonResponse(array('message'=>$response));
        }
        return new JsonResponse(array('message'=>"You haven't permissions to access this functionality."));
    }


                   /**
     * @Route("/my-broadcast/list")
     * @Rest\Get("/my-broadcast/list")
     * @ApiDoc(
     *  section = "Broadcast",
     *  description="List of all broadcast liked",
    *  )
     */
    public function myBroadcastAction()
    {
       $request = $this->getRequest();
        if ($this->get('security.context')->isGranted('ROLE_MEMBER')  === TRUE) {
            $user = $this->get('security.context')->getToken()->getUser();
            $em = $this->getDoctrine()->getEntityManager();
            $broadcasts = $user->getLikeBroadcast();
            $response=array();
            $response["video"]=array();
            $response["picture"]=array();
            foreach ($broadcasts as $key => $bc) {
                
                $array["id"]  = $bc->getBroadcast()->getId();
                $array["url"] = $bc->getBroadcast()->getMedia()->getURL();
                $array["date"]= $bc->getBroadcast()->getDate();
                $array["title"]=$bc->getBroadcast()->getName();
                $array["description"]=$bc->getBroadcast()->getDescription();
                    if($bc->getBroadcast()->getSurvey()!=null)
                $array["survey"]= $bc->getBroadcast()->getSurvey()->getId();
                    else
                $array["survey"]="";
            if ($bc->getBroadcast()->getMedia()->getFormat()=="video")
                $response["video"][]=$array;
            if ($bc->getBroadcast()->getMedia()->getFormat()=="picture")
                 $response["picture"][]=$array;
            }
            return new JsonResponse(array('message'=>"ok",'broadcast'=>$response));
        }
        
        return new JsonResponse(array('message'=>"You haven't permissions to access this functionality."));


    }
      

    
   
}
