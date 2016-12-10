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
            ->join('following.user', 'user1')
            ->join('follow.follower', 'follower')
            ->join('follower.user', 'user2');
         $qb->andWhere('user1.id = :following')->setParameter('following', $filters['following']);
         $qb->andWhere('user2.id = :follower')->setParameter('follower', $filters['follower']);
        
         unset($filters['follower']);
         unset($filters['following']);
         
         if (count($this->filterQB($qb, $filters, ResultType::ArrayType))>0)
         	return true;
         	return false;
     }
       public function returnFollowingMemberID($filters = array(),$order=null,$resultType=ResultType::ObjectType){

         $qb = $this->getQB();
         $qb->join('follow.following', 'member')
            ->join('member.groups', 'groups')
            ->join('member.user', 'user');
         $qb->andWhere('user.id = :user')->setParameter('user', $filters['user']);
         $qb->andWhere('groups.id = :group')->setParameter('group', $filters['group']);
         if (count($qb->getQuery()->getResult())>0)
            return $qb->getQuery()->getSingleResult()->getFollowing()->getId();
            return false;
     }
            public function returnFollowerMemberID($filters = array(),$order=null,$resultType=ResultType::ObjectType){
         $qb = $this->getQB();
         $qb->join('follow.follower', 'member')
            ->join('member.groups', 'groups')
            ->join('member.user', 'user');
         $qb->andWhere('user.id = :user')->setParameter('user', $filters['user']);
         $qb->andWhere('groups.id = :group')->setParameter('group', $filters['group']);
         if (count($qb->getQuery()->getResult())>0)
            return $qb->getQuery()->getSingleResult()->getFollower()->getId();
            return false;
     }

     public function  getFollower($filters = array(),$order=null,$resultType=ResultType::ObjectType){
         $qb = $this->getQB();
         $qb->join('follow.following', 'following')
           ->join('follow.follower', 'follower');
         $qb->andWhere('following.id = :following')->setParameter('following', $filters['following']);
         $qb->andWhere('follower.id = :follower')->setParameter('follower', $filters['follower']);
        
         unset($filters['follower']);
         unset($filters['following']);
         
         if (count($this->filterQB($qb, $filters, ResultType::ArrayType))>0)
            return $this->filterQB($qb, $filters, ResultType::ObjectType);
        return null;
     }

     public function  unfollowMember($filters = array(),$order=null,$resultType=ResultType::ObjectType){
        $em = $this->getEntityManager();
         $qb = $this->getQB();
         $qb->join('follow.following', 'following')
            ->join('following.user', 'user1')
            ->join('follow.follower', 'follower')
            ->join('follower.user', 'user2');
         $qb->andWhere('user1.id = :following')->setParameter('following', $filters['following']);
         $qb->andWhere('user2.id = :follower')->setParameter('follower', $filters['follower']);
        
         unset($filters['follower']);
         unset($filters['following']);

         $members = $this->filterQB($qb, $filters, ResultType::ObjectType);

         foreach ($members as $key => $value) {
             $em->remove($value);
             $em->flush();
         }
         return true;
     }


         public function searchFollowers($filters = array(),$order=null,$resultType=ResultType::ObjectType){
                     $qb = $this->getQB();
         $qb->join('follow.following', 'following')
         ->join('following.user', 'user1')
           ->join('follow.follower', 'member')
           ->join('member.user', 'user')
           ->join('user.profile', 'profile');
         $qb->where('user1.id = :following')->setParameter('following', $filters['following']);
             
                $qb->andWhere('profile.name LIKE :search
                               OR profile.lastname LIKE :search')  
                               ->setParameter('search', '%'.$filters['search'].'%');                    
        unset($filters['search']);
         unset($filters['following']);
         
         if (count($this->filterQB($qb, $filters, ResultType::ArrayType))>0)
            return $this->filterQB($qb, $filters, ResultType::ObjectType);
        return array();                     
}

}
