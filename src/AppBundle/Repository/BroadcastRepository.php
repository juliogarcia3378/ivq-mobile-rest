<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use Core\ComunBundle\Util\UtilRepository2;

class BroadcastRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
     public function listBroadcastByGroup($filters = array(),$order=null,$resultType=ResultType::ObjectType){
    
    $em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('b')
	   ->from('AppBundle:Broadcast', 'b')
	   ->join('b.groups', 'g')
         ->where('g.id = :group')
         ->setParameter('group', $filters["group"]);
          if (isset($filters["start"]) && isset($filters["limit"])){
          
         $qb->setFirstResult($filters["start"])
       		  ->setMaxResults($filters["limit"]);
			}

	 	$response= $qb->getQuery()->getResult();
	 	UtilRepository2::getSession()->set("total", count($response));
             $array = array();
	 	foreach ($response as $key => $broadcast) {
	 		$aux["id"]= $broadcast->getId();
	 		$aux["title"]= $broadcast->getName();
	 		$aux["description"]= $broadcast->getDescription();
	 		$aux["url"]= $broadcast->getPath();
	 		$aux["date"]= $broadcast->getDate();
	 		if($broadcast->getSurvey()!=null)
	 		$aux["survey"]= $broadcast->getSurvey()->getId();
	 		$array[]=$aux;
	 	}
	 	return $array;
	 }
     public function havePermissions($filters = array(),$order=null,$resultType=ResultType::ObjectType){
    
    $em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('b')
	    ->from('AppBundle:Broadcast', 'b')
	    ->join('b.groups', 'g')
	    ->join('g.member', 'm')
	    ->join('m.user', 'u')
        ->where('b.id = :broadcast')
        ->andWhere('u.id = :user')
        ->setParameter('broadcast', $filters["broadcast"])
        ->setParameter('user', $filters["user"]);


         $response = $qb->getQuery()->getResult();
	 	if (count($response)>0)
	 		return true;
	 	return false;

	 }

}
