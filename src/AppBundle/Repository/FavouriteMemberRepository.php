<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\FavouriteMember;
use Symfony\Component\HttpFoundation\JsonResponse;
use Core\ComunBundle\Util\UtilRepository2;

class FavouriteMemberRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
 
 public function byUser($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('f')
	     ->from('AppBundle:FavouriteMember', 'f')
	     ->join('f.user', 'u')
          ->join('f.member', 'g')
          ->join('g.user', 'us')
          ->join('us.profile', 'p')
         ->where('u.id = :user')
         ->setParameter('user', $array["user"]);
         if (isset($array["start"]) && isset($array["limit"])){
         $qb->setFirstResult($array["start"])
         ->setMaxResults($array["limit"]);
			}
	     $qb->orderBy('p.name', 'ASC');
	 	$response= $qb->getQuery()->getResult();
             $array = array();
             UtilRepository2::getSession()->set("total", count($response));
	 	foreach ($response as $key => $favourite_member) {
          
            $aux["id"]= $favourite_member->getMember()->getId();
            $profile=$favourite_member->getMember()->getUser()->getProfile();
            if ($profile==null){
                $aux["name"]= "";
                $aux["logo"]= "";
                $aux["address"]= "";
            }
            else {
    	 		$aux["name"]= $favourite_member->getMember()->getUser()->getProfile()->getFullName();
                $aux["logo"]= $favourite_member->getMember()->getUser()->getProfile()->getAvatar()->getURL();
    	 		$aux["address"]= $favourite_member->getMember()->getUser()->getProfile()->getAddress()->getCityAndState();
            }
	 		$array[]=$aux;

	 	}
    
	 	return $array;

 }   

 public function addFavorite($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('fm')
	     ->from('AppBundle:FavouriteMember', 'fm')
	     ->join('fm.member', 'm')
	     ->join('fm.user', 'u')
         ->where('m.id = :idMember')
         ->andWhere('u.id = :user')
         ->setParameter('user', $array["user"]->getId())
         ->setParameter('idMember', $array["member"]->getId());
	 	$exist= $qb->getQuery()->getResult();
        
        if (count($exist)==0){
             $favoriteMember = new FavouriteMember();
             $favoriteMember->setMember($array["member"]);
             $favoriteMember->setUser($array["user"]);
             $em->persist($favoriteMember);
             $em->flush();
             return  array("message"=>"Member added sucesfully to favorite list.");
        }else {
         return  array("message"=>"This member is already a favorite.");
      
        }
 }  


  public function removeFavorite($array)
 {
 	 	$em = $this->getEntityManager();
 	   $qb = $em->createQueryBuilder();
	 	$qb->select('fg')
	     ->from('AppBundle:FavouriteMember', 'fg')
         ->join('fg.member', 'm')
         ->join('fg.user', 'u')
         ->where('m.id = :member')
         ->andWhere('u.id = :user')
         ->setParameter('user', $array["user"]->getId())
         ->setParameter('member', $array["member"]->getId());
        $exist= $qb->getQuery()->getResult();
        
        if (count($exist)!=0){
             $em->remove($exist[0]);
             $em->flush();
             return array("message"=>"You removed sucesfully the member from favorites .");
        }else {
         return array("message"=>"This member is not a favorite.");
      
        }

 }  

}
