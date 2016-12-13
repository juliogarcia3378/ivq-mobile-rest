<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Comment;
use Core\ComunBundle\Util\UtilRepository2;

class CommentRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
   
 public function byMediaEvent($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('me')
	   ->from('AppBundle:Comment', 'me')
	   ->join('me.media', 'e')
         ->where('e.id = :me')
         ->setParameter('me', $array["idMedia"]);
         
	     $qb->orderBy('me.date', 'DESC');
	 	$response= $qb->getQuery()->getResult();
	 	UtilRepository2::getSession()->set("total", count($response));

	 	if (isset($array["start"]) && isset($array["limit"])){
         $qb->setFirstResult($array["start"])
         ->setMaxResults($array["limit"]);
			}
		$response= $qb->getQuery()->getResult();


             $array = array();
	 	foreach ($response as $key => $comment) {
	 		$arr['id']=$comment->getId();
                    $arr['comment']=$comment->getComment();
                    $arr['date']=$comment->getDate();
                    $profile= $comment->getUser()->getProfile();

                    //$arr['memberId']=$comment->getMedia()->getMediaEvent()->getId();
                    $arr['user']["id"]=$comment->getUser()->getId();
                    if ($profile==null){
                    $arr['user']["name"]="";
                    $arr['user']["avatar"]="";
                    }
                    else{
                    $arr['user']["name"]=$comment->getUser()->getProfile()->getFullname();
                    $arr['user']["avatar"]=$comment->getUser()->getProfile()->getAvatar()->getURL();
                    }
	 		$array[]=$arr;
	 	}
	 	return $array;

     } 

	  public function addComment($array)
	 {
	 	$em = $this->getEntityManager();

	             $comment = new Comment();
	             $comment->setUser($array["user"]);
	             $comment->setMedia($array["media"]);
	             $comment->setComment($array["comment"]);
	             $em->persist($comment);
	             $em->flush();
	             return  array("message"=>"You have succesfully added a new comment.");
	       
	 }  


}
