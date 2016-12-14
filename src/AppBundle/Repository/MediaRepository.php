<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use AppBundle\Entity\LikeMedia;
use Doctrine\ORM\Mapping as ORM;

class MediaRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
   
    public function like($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('me')
	    ->from('AppBundle:Media', 'me')
	    ->join('me.likeMedia', 'lm')
	    ->join('lm.user', 'u')
        ->where('u.id = :user')
        ->andWhere('me.id = :idMedia')
        ->setParameter('user', $array["user"]->getId())
        ->setParameter('idMedia', $array["media"]->getId());
	 	$exist= $qb->getQuery()->getResult();
        
        if (count($exist)==0){
             $likeMedia = new LikeMedia();
             $likeMedia->setMedia($array["media"]);
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
