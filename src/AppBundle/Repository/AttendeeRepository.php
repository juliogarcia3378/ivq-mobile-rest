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
    $idGroup = $em->getRepository("AppBundle:Event")->find($array['event'])->getGroups()->getId();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('attendee')
	     ->from('AppBundle:Attendee', 'attendee')
	     ->join('attendee.event', 'event')
	     ->join('attendee.user', 'user')
         ->join('event.groups', 'group')
         ->join('user.member', 'member')
	     ->join('user.profile', 'profile')
         ->where('event.id = :event')
         ->setParameter('event', $array["event"]);
			
	     $qb->orderBy('profile.name', 'ASC');
	 	 $response= $qb->getQuery()->getResult();
         UtilRepository2::getSession()->set("total", count($response));

          if (isset($array["start"]) && isset($array["limit"]))
          {
            $qb->setFirstResult($array["start"])
            ->setMaxResults($array["limit"]);
          }
          $response= $qb->getQuery()->getResult();

        $array = array();
	 	foreach ($response as $key => $attendee) {
            $aux["idUser"]= $attendee->getUser()->getId();
            $aux["idMember"]= $em->getRepository("AppBundle:Member")->returnMemberID(array('user'=>$aux["idUser"],'group'=>$idGroup));
	 		$aux["name"]= $attendee->getUser()->getProfile()->getName();
	 		$aux["lastname"]= $attendee->getUser()->getProfile()->getLastname();
            $avatar = $attendee->getUser()->getProfile()->getAvatar();
            if ($avatar==null)
            $aux["avatar"]= "";
            else    
	 		$aux["avatar"]= $attendee->getUser()->getProfile()->getAvatar()->getURL();
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
