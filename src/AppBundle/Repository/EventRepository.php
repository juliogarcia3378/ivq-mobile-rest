<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\LikeEvent;
use Core\ComunBundle\Util\UtilRepository2;

class EventRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
 
 public function byGroup($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('e')
	    ->from('AppBundle:Event', 'e')
	    ->join('e.groups', 'g')
        ->where('g.id = :group')
        ->setParameter('group', $array["group"]);
         if (isset($array["start"]) && isset($array["limit"])){
         $qb->setFirstResult($array["start"])
         ->setMaxResults($array["limit"]);
			}
	     $qb->orderBy('e.name', 'ASC');
	 	$response= $qb->getQuery()->getResult();

	 	UtilRepository2::getSession()->set("total", count($response));


             $array = array();
	 	foreach ($response as $key => $event) {
	 		$aux["id"]= $event->getId();
	 		$aux["name"]= $event->getName();
	 	    $aux["paid_event"]= $event->getPaidevent();
	 		if ($aux["paid_event"]!=false)
	 			$aux["ticket"]= $event->getTicketURL();
	 	    else
	 	    	$aux["ticket"]= "";
	 		$aux["information"]= $event->getInformation();
	 		$aux["date"]= $event->getDate();
	 		$aux["updated_at"]= $event->getUpdatedAt();
	 		$aux["website"]= $event->getWebsite();
	 		$aux["logo"]= $event->getLogo()->getURL();
	 		$aux["price"]= $event->getPrice();
	 		$aux["address"]=$event->getAddress()->getDescription();
	 		$array[]=$aux;
	 	}
	 	return $array;

 }   

  public function byId($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('e')
	    ->from('AppBundle:Event', 'e')
        ->where('e.id = :event')
        ->setParameter('event', $array["event"]);
	 	$event= $qb->getQuery()->getSingleResult();


	 		$aux["id"]= $event->getId();
	 		$aux["name"]= $event->getName();
	 		$aux["information"]= $event->getInformation();
	 		$aux["paid_event"]= $event->getPaidevent();
	 		if ($aux["paid_event"]!=false)
	 			$aux["ticket"]= $event->getTicketURL();
	 		else
	 			$aux["ticket"]="";
	 		$aux["date"]= $event->getDate();
	 		$aux["updated_at"]= $event->getUpdatedAt();
	 		$aux["website"]= $event->getWebsite();
	 		$aux["logo"]= $event->getLogo()->getURL();
	 		$aux["address"]=$event->getAddress()->getDescription();
	 	return $aux;

 }  

     public function like($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('le')
	     ->from('AppBundle:LikeEvent', 'le')
	     ->join('le.event', 'e')
	     ->join('le.user', 'u')
         ->where('u.id = :user')
         ->andWhere('e.id = :idEvent')
         ->setParameter('user', $array["user"]->getId())
         ->setParameter('idEvent', $array["event"]->getId());
	 	$exist= $qb->getQuery()->getResult();
        
        if (count($exist)==0){
             $likeEvent = new LikeEvent();
             $likeEvent->setEvent($array["event"]);
             $likeEvent->setUser($array["user"]);
             $em->persist($likeEvent);
             $em->flush();
             return  array("message"=>"You liked sucesfully this event.");
        }else {
         return  array("message"=>"You already liked this event before.");
        }
 }  


  public function disLike($array)
 {
  	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('le')
	     ->from('AppBundle:LikeEvent', 'le')
	     ->join('le.event', 'e')
	     ->join('le.user', 'u')
         ->where('u.id = :user')
         ->andWhere('e.id = :idEvent')
         ->setParameter('user', $array["user"]->getId())
         ->setParameter('idEvent', $array["event"]->getId());
	 	$exist= $qb->getQuery()->getResult();
        
        
        if (count($exist)!=0){
        	$id = $exist[0];
             $em->remove($em->getRepository("AppBundle:LikeEvent")->find($id));
             $em->flush();
             return  array("message"=>"You unliked this event.");
        }else {
         return  array("message"=>"This event is not liked by you.");
        }
      
 }

}
