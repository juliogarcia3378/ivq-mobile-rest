<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use Core\ComunBundle\Util\UtilRepository2;
use AppBundle\Entity\LikeBroadcast;

class BroadcastRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
    public function listBroadcastByGroup($filters = array(),$order=null,$resultType=ResultType::ObjectType){
    
    $em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('b')
	   ->from('AppBundle:Broadcast', 'b')
	   ->join('b.groups', 'g')
         ->where('g.id = :group')
         ->andWhere('b.status = 1')
         ->setParameter('group', $filters["group"]);
          if (isset($filters["start"]) && isset($filters["limit"])){
          
         $qb->setFirstResult($filters["start"])
       		  ->setMaxResults($filters["limit"]);
			}

	 	$response= $qb->getQuery()->getResult();
	 	UtilRepository2::getSession()->set("total", count($response));
	 	$array["picture"]=array();
	 	$array["video"]=array();
             $array = array();
	 	foreach ($response as $key => $broadcast) {
	 		$aux["id"]= $broadcast->getId();
	 		$aux["title"]= $broadcast->getName();
	 		$aux["format"]= $broadcast->getFormat();
	 		$aux["description"]= $broadcast->getDescription();
	 		$aux["url"]= $broadcast->getMedia()->getURL();
	 		$aux["date"]= $broadcast->getDate();
	 		if($broadcast->getSurvey()!=null)
	 		$aux["survey"]= $broadcast->getSurvey()->getId();
	 	else
	 		$aux["survey"]="";
	 	    $media = $broadcast->getMedia()->getFormat();
	 	if ($media=='picture')
	 		$array["picture"][]=$aux;
	 	if ($media=='video')
	 		$array["video"][]=$aux;
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


    public function like($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('lb')
	     ->from('AppBundle:LikeBroadcast', 'lb')
	     ->join('lb.broadcast', 'br')
	     ->join('lb.user', 'u')
         ->where('u.id = :user')
         ->andWhere('br.id = :idBroadcast')
         ->setParameter('user', $array["user"]->getId())
         ->setParameter('idBroadcast', $array["broadcast"]->getId());
	 	$exist= $qb->getQuery()->getResult();
        
        if (count($exist)==0){
             $likeBroadcast = new likeBroadcast();
             $likeBroadcast->setBroadcast($array["broadcast"]);
             $likeBroadcast->setUser($array["user"]);
             $em->persist($likeBroadcast);
             $em->flush();
             return  array("message"=>"You liked sucesfully this broadcast.");
        }else {
         return  array("message"=>"You already liked this broadcast before.");
        }
 }  


  public function disLike($array)
 {
  	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('lb')
	     ->from('AppBundle:LikeBroadcast', 'lb')
	     ->join('lb.broadcast', 'br')
	     ->join('lb.user', 'u')
         ->where('u.id = :user')
         ->andWhere('br.id = :idBroadcast')
         ->setParameter('user', $array["user"]->getId())
         ->setParameter('idBroadcast', $array["broadcast"]->getId());
	 	$exist= $qb->getQuery()->getResult();
        
        if (count($exist)!=0){
        	$id = $exist[0];
            $em->remove($em->getRepository("AppBundle:LikeBroadcast")->find($id));
            $em->flush();
            return  array("message"=>"You unliked this broadcast.");
        }else {
         return  array("message"=>"This broadcast is not liked by you.");
        }
      
 }

}
