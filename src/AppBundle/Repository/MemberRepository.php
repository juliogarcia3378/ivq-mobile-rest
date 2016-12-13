<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Member;
use Core\ComunBundle\Util\UtilRepository2;

class MemberRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
   
    public function listMembersByGroup($filters = array(),$order=null,$resultType=ResultType::ObjectType){
    
    $em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('e')
	   ->from('AppBundle:Member', 'e')
	   ->join('e.groups', 'g')
         ->where('g.id = :group')
         ->setParameter('group', $filters["group"]);
          if (isset($filters["start"]) && isset($filters["limit"])){
          
         $qb->setFirstResult($filters["start"])
       		  ->setMaxResults($filters["limit"]);
			}

	 	$response= $qb->getQuery()->getResult();
	 	UtilRepository2::getSession()->set("total", count($response));
             $array = array();
             
	 	foreach ($response as $key => $member) {
	 		$aux["id"]= $member->getUser()->getId();
	 		$profile= $member->getUser()->getProfile();
	 		if ($profile==null){
	 		$aux["name"]= "";
	 		$aux["followers"]= count($member->getFollowing());
	 		$aux["lastname"]= "";
	 		$aux["idMember"]= $member->getId();
	 		$aux["avatar"]= "";
	 		}else{
	 		$aux["name"]= $member->getUser()->getProfile()->getName();
	 		$aux["followers"]= count($member->getFollowing());
	 		$aux["lastname"]= $member->getUser()->getProfile()->getLastname();
	 		$aux["idMember"]= $member->getId();
	 		$aux["avatar"]= $member->getUser()->getProfile()->getAvatar()->getURL();
	 		}
	 		$array[]=$aux;
	 	}
	 	
	 	return $array;
	 }

	     public function viewProfileMember($filters = array(),$order=null,$resultType=ResultType::ObjectType){
    $em = $this->getEntityManager();
 	$qb = $em->createQueryBuilder();
	 	$qb->select('e')
	   ->from('AppBundle:Member', 'e')
	   ->join('e.groups', 'g')
         ->where('g.id = :group')
         ->setParameter('group', $filters["group"]);
	 	$response= $qb->getQuery()->getResult();
             $array = array();
	 	foreach ($response as $key => $member) {
	 		$aux["id"]= $member->getUser()->getId();
	 		$aux["idMember"]= $member->getId();
	 		$aux["name"]= $member->getUser()->getProfile()->getName();
	 		$aux["lastname"]= $member->getUser()->getProfile()->getLastname();
	 		$aux["avatar"]= $member->getUser()->getProfile()->getAvatar();
	 		$array[]=$aux;
	 	}
	 	return $array;
	 }
      
      public function returnMemberID($filters = array(),$order=null,$resultType=ResultType::ObjectType){
      	$em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('a')
	  		 ->from('AppBundle:Member', 'a')
        	 ->join('a.groups', 'groups')
             ->join('a.user', 'user');
         $qb->andWhere('user.id = :user')->setParameter('user', $filters['user']);
         $qb->andWhere('groups.id = :group')->setParameter('group', $filters['group']);
         $result = $qb->getQuery()->getResult();
         if (count($result)==0)
         	return null;
         return $result[0]->getId();

     }
	 public function joinGroup($user,$group_id){
        $em = $this->getEntityManager();
	 	$group = $em->getRepository("AppBundle:Groups")->find($group_id);
	 	 if ($group==null)
	 	 	return "The group is not valid.";
	 	 $member = new Member();
	 	 $member->setUser($user);
	 	 $member->setGroups($group);
	 	 $em->persist($member);
         $em->flush();
            return "You are joined sucesfully this group.";
	 }
    public function disjoinGroup($user,$group_id)
    {
         $em = $this->getEntityManager();
 	    $qb = $em->createQueryBuilder();
	 	$qb->select('e')
	   ->from('AppBundle:Member', 'e')
	   ->join('e.groups', 'g')
	   ->join('e.user', 'u')
         ->where('g.id = :group')
         ->andWhere('u.id = :user')
         ->setParameter('user', $user)
         ->setParameter('group', $group_id);
	 	$member= $qb->getQuery()->getResult();
          if ($member ==null)
          {
          		return "You are not member in this group.";
          }
          else {
                $em->remove($member[0]);
             
                $em->flush();
                 return "You are disjoined this group.";
          }
     }



}
