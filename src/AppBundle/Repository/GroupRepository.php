<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;

class GroupRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{

	public function isMember($filters = array(),$order=null,$resultType=ResultType::ObjectType){
         $qb = $this->getQB();
           
        $qb->join('groups.member', 'member')
           ->join('member.user', 'user');
         
         $qb->andWhere('user.id = :user')->setParameter('user', $filters['user']);
         $qb->andWhere('groups.id = :group')->setParameter('group', $filters['group']);
        
         unset($filters['user']);
         unset($filters['group']);
         
         if (count($this->filterQB($qb, $filters, ResultType::ArrayType))>0)
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
