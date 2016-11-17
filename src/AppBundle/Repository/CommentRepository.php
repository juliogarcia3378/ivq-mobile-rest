<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Comment;

class CommentRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
   
 public function byMediaEvent($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('me')
	   ->from('AppBundle:Comment', 'me')
	   ->join('me.mediaEvent', 'e')
         ->where('e.id = :me')
         ->setParameter('me', $array["idMedia"]);
         if (isset($array["start"]) && isset($array["limit"])){
         $qb->setFirstResult($array["start"])
         ->setMaxResults($array["limit"]);
			}
	     $qb->orderBy('e.date', 'ASC');
	 	$response= $qb->getQuery()->getResult();
             $array = array();
	 	foreach ($response as $key => $comment) {
	 		$arr['id']=$comment->getId();
                    $arr['comment']=$comment->getComment();
                    $arr['date']=$comment->getDate();
                    $arr['user']["id"]=$comment->getUser()->getId();
                    $arr['user']["name"]=$comment->getUser()->getProfile()->getFullname();
                    $arr['user']["avatar"]=$comment->getUser()->getProfile()->getAvatar();
	 		$array[]=$arr;
	 	}
	 	return $array;

     } 

	  public function addComment($array)
	 {
	 	$em = $this->getEntityManager();

	             $comment = new Comment();
	             $comment->setUser($array["user"]);
	             $comment->setMediaEvent($array["mediaEvent"]);
	             $comment->setComment($array["comment"]);
	             $em->persist($comment);
	             $em->flush();
	             return  array("message"=>"You have succesfully added a new comment.");
	       
	 }  


}
