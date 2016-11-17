<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\LikeMedia;

class MediaEventRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
   
 public function byEvent($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('me')
	   ->from('AppBundle:MediaEvent', 'me')
	   ->join('me.event', 'e')
         ->where('e.id = :event')
         ->setParameter('event', $array["event"]);
         if (isset($array["start"]) && isset($array["limit"])){
         $qb->setFirstResult($array["start"])
         ->setMaxResults($array["limit"]);
			}
	     $qb->orderBy('e.name', 'ASC');
	 	$response= $qb->getQuery()->getResult();
             $array = array();
	 	foreach ($response as $key => $mediaevent) {
	 		$aux["id"]= $mediaevent->getId();
	 		$aux["url"]= $mediaevent->getMedia()->getURL();
	 		$aux["user"]["id"]= $mediaevent->getMedia()->getUser()->getId();
	 		$aux["user"]["avatar"]= $mediaevent->getMedia()->getUser()->getProfile()->getAvatar();
	 		$aux["user"]["fullname"]= $mediaevent->getMedia()->getUser()->getProfile()->getFullname();
	 		$aux["user"]["address"]= $mediaevent->getMedia()->getUser()->getProfile()->getAddress()->getCityAndState();
	 		$aux["date"]= $mediaevent->getDate();
			$aux["comment"]= $mediaevent->getComment();
			$aux["likes"]= count($mediaevent->getLikeMedia());
			$aux["comments"]= count($mediaevent->getComments());
	 		$array[]=$aux;
	 	}
	 	return $array;

 } 

  public function like($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('me')
	     ->from('AppBundle:MediaEvent', 'me')
	     ->join('me.likemedia', 'lm')
	     ->join('lm.user', 'u')
         ->where('u.id = :user')
         ->andWhere('me.id = :idMedia')
         ->setParameter('user', $array["user"]->getId())
         ->setParameter('idMedia', $array["media"]->getId());
	 	$exist= $qb->getQuery()->getResult();
        
        if (count($exist)==0){
             $likeMedia = new LikeMedia();
             $likeMedia->setMediaEvent($array["media"]);
             $likeMedia->setUser($array["user"]);
             $em->persist($likeMedia);
             $em->flush();
             return  array("message"=>"You liked sucesfully this media.");
        }else {
         return  array("message"=>"You already liked this media before.");
      
        }
 }  


  public function removeLike($array)
 {
 	 	$em = $this->getEntityManager();
 	   $qb = $em->createQueryBuilder();
	 	$qb->select('e')
	     ->from('AppBundle:Attendee', 'e')
	     ->join('e.event', 'g')
	     ->join('e.user', 'u')
         ->where('g.id = :event')
         ->andWhere('u.id = :user')
         ->setParameter('user', $array["user"]->getId())
         ->setParameter('event', $array["event"]->getId());
	 	$exist= $qb->getQuery()->getResult();
        
        if (count($exist)!=0){
             $em->remove($exist[0]);
             $em->flush();
             return array("message"=>"You aren't a attendee for this event.");
        }else {
         return array("message"=>"You left this event.");
      
        }

 }

}
