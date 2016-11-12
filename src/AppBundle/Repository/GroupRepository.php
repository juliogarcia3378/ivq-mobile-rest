<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Core\ComunBundle\Util\UtilRepository2;

class GroupRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
    
    public function search($filters = array(),$order=null,$resultType=ResultType::ObjectType){
         $qb = $this->getQB();
        $qb->join('groups.category', 'category');
        if ($filters["search"]!=null)
         $qb->andWhere('groups.name LIKE :search')->setParameter('search', "%".$filters['search']."%");
     if ($filters["category"]!=null)
         $qb->andWhere('category.id = :category')->setParameter('category', $filters['category']);
        
         unset($filters['search']);
         unset($filters['category']);
         
         return $this->filterQB($qb, $filters, ResultType::ObjectType);
     }


	public function isMember($filters = array(),$order=null,$resultType=ResultType::ObjectType){
         $qb = $this->getQB();
        $qb->join('groups.member', 'member')
           ->join('member.user', 'user');
         $qb->andWhere('user.id = :user')->setParameter('user', $filters['user']);
         $qb->andWhere('groups.id = :group')->setParameter('group', $filters['group']);
         if (count($qb->getQuery()->getResult())>0)
         	return true;
         	return false;
     }


     	public function listMembers($filters = array(),$order=null,$resultType=ResultType::ObjectType){
         $qb = $this->getQB();
           
        $qb->join('groups.member', 'member')
           ->join('member.user', 'user');
         
         $qb->andWhere('groups.id = :group')->setParameter('group', $filters['group']);
        
         unset($filters['user']);
         unset($filters['group']);
         
         return $this->filterQB($qb, $filters, ResultType::ArrayType);
     }
   
}
