<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;

class FollowRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
   	public function  isFollower($filters = array(),$order=null,$resultType=ResultType::ObjectType){
         $qb = $this->getQB();
        $qb->join('follow.following', 'following')
           ->join('follow.follower', 'follower');
         $qb->andWhere('following.id = :following')->setParameter('following', $filters['following']);
         $qb->andWhere('follower.id = :follower')->setParameter('follower', $filters['follower']);
        
         unset($filters['follower']);
         unset($filters['following']);
         
         if (count($this->filterQB($qb, $filters, ResultType::ArrayType))>0)
         	return true;
         	return false;
     }

}
