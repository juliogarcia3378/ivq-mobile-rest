<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;

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
             $array = array();
	 	foreach ($response as $key => $event) {
	 		$aux["id"]= $event->getId();
	 		$aux["name"]= $event->getName();
	 	    $aux["paid_event"]= $event->getPaidevent();
	 		if ($aux["paid_event"]!=false)
	 		$aux["ticket"]= $event->getTicketURL();
	 		$aux["information"]= $event->getInformation();
	 		$aux["date"]= $event->getDate();
	 		$aux["updated_at"]= $event->getUpdatedAt();
	 		$aux["website"]= $event->getWebsite();
	 		$aux["logo"]= $event->getLogo();
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
	 		$aux["date"]= $event->getDate();
	 		$aux["updated_at"]= $event->getUpdatedAt();
	 		$aux["website"]= $event->getWebsite();
	 		$aux["logo"]= $event->getLogo();
	 		$aux["address"]=$event->getAddress()->getDescription();
	 	return $aux;

 }  
}
