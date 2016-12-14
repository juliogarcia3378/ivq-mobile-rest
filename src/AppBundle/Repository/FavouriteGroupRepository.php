<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\FavouriteGroup;
use Symfony\Component\HttpFoundation\JsonResponse;
use Core\ComunBundle\Util\UtilRepository2;

class FavouriteGroupRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
 
 public function byUser($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('f')
	     ->from('AppBundle:FavouriteGroup', 'f')
	     ->join('f.user', 'u')
          ->join('f.groups', 'g')
         ->where('u.id = :user')
         ->setParameter('user', $array["user"]);
         if (isset($array["start"]) && isset($array["limit"])){
         $qb->setFirstResult($array["start"])
         ->setMaxResults($array["limit"]);
			}
	     $qb->orderBy('g.name', 'ASC');
	 	$response= $qb->getQuery()->getResult();
             $array = array();
	 	foreach ($response as $key => $favourite_group) {
            $aux["id"]= $favourite_group->getGroups()->getId();
	 		$aux["name"]= $favourite_group->getGroups()->getName();
            $aux["logo"]= $favourite_group->getGroups()->getLogo()->getURL();
	 		$aux["category"]= $favourite_group->getGroups()->getCategory()->getName();
	 		$aux["address"]= $favourite_group->getGroups()->getAddress()->getCityAndState();
	 		$array[]=$aux;
	 	}
	 	return $array;

 }   

 public function addFavorite($array)
 {
 	$em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('fg')
	    ->from('AppBundle:FavouriteGroup', 'fg')
	    ->join('fg.groups', 'g')
	    ->join('fg.user', 'u')
        ->where('g.id = :groups')
        ->andWhere('u.id = :user')
        ->setParameter('user', $array["user"]->getId())
        ->setParameter('groups', $array["groups"]->getId());
	 	$exist= $qb->getQuery()->getResult();
        
        if (count($exist)==0){
             $favoriteGroup = new FavouriteGroup();
             $favoriteGroup->setGroups($array["groups"]);
             $favoriteGroup->setUser($array["user"]);
             $em->persist($favoriteGroup);
             $em->flush();
             return  array("message"=>"Group added sucesfully to favorite list.");
        }else {
         return  array("message"=>"This group is already a favorite.");
      
        }
 }  


  public function removeFavorite($array)
 {
 	 	$em = $this->getEntityManager();
 	   $qb = $em->createQueryBuilder();
	 	$qb->select('fg')
	     ->from('AppBundle:FavouriteGroup', 'fg')
         ->join('fg.groups', 'g')
         ->join('fg.user', 'u')
         ->where('g.id = :groups')
         ->andWhere('u.id = :user')
         ->setParameter('user', $array["user"]->getId())
         ->setParameter('groups', $array["groups"]->getId());
        $exist= $qb->getQuery()->getResult();
        
        if (count($exist)!=0){
             $em->remove($exist[0]);
             $em->flush();
             return array("message"=>"You removed sucesfully the group from favourites .");
        }else {
         return array("message"=>"This group is not a favourite.");
      
        }

 }  

}
