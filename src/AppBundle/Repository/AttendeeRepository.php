<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Attendee;
use Symfony\Component\HttpFoundation\JsonResponse;
use Core\ComunBundle\Util\UtilRepository2;

class AttendeeRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
 
 public function byEvent($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('e')
	     ->from('AppBundle:Attendee', 'e')
	     ->join('e.event', 'g')
	     ->join('e.user', 'u')
	     ->join('u.profile', 'p')
         ->where('g.id = :event')
         ->setParameter('event', $array["event"]);
         if (isset($array["start"]) && isset($array["limit"])){
         $qb->setFirstResult($array["start"])
         ->setMaxResults($array["limit"]);
			}
	     $qb->orderBy('p.name', 'ASC');
	 	$response= $qb->getQuery()->getResult();
             $array = array();
	 	foreach ($response as $key => $attendee) {
	 		$aux["idUser"]= $attendee->getUser()->getId();
	 		$aux["name"]= $attendee->getUser()->getProfile()->getName();
	 		$aux["lastname"]= $attendee->getUser()->getProfile()->getLastname();
	 		$aux["avatar"]= $attendee->getUser()->getProfile()->getAvatar();
	 		$array[]=$aux;
	 	}
	 	return $array;

 }   

 public function confirmAttendance($array)
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
        
        if (count($exist)==0){
             $attendee = new Attendee();
             $attendee->setEvent($array["event"]);
             $attendee->setUser($array["user"]);
             $em->persist($attendee);
             $em->flush();
             return  array("message"=>"You have succesfully confirmed to assist this event.");
        }else {
         return  array("message"=>"You already confirmed to assist this event.");
      
        }
 }  


  public function cancelAttendance($array)
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
