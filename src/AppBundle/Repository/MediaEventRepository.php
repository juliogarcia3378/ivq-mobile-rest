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
	 		$aux["id"]= $mediaevent->getMedia()->getId();
	 		$aux["url"]= $mediaevent->getMedia()->getURL();
            $user=$mediaevent->getMedia()->getUser();
	 		$aux["user"]["id"]= $user->getId();

            $profile=$user->getProfile();
            if ($profile!=null){
	 		$aux["user"]["avatar"]= $profile->getAvatar()->getURL();
	 		$aux["user"]["fullname"]= $profile->getFullname();
	 		$aux["user"]["address"]= $profile->getAddress()->getCityAndState();
        }else {
            $aux["user"]["avatar"]= "";
            $aux["user"]["fullname"]= "";
            $aux["user"]["address"]= "";
        }
	 		$aux["date"]=    $mediaevent->getDate();
			$aux["comment"]= $mediaevent->getComment();
			$aux["likes"]=   $mediaevent->getMedia()->getLikesJSON();
			$aux["comments"]=$mediaevent->getMedia()->getCommentsJSON();
	 		$array[]=$aux;
	 	}
	 	return $array;

 } 

 

}
