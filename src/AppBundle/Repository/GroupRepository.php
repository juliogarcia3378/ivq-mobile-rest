<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Core\ComunBundle\Util\UtilRepository2;
use Zippopotamus\Service\Zippopotamus;

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

    public function searchNearby($filters = array(),$order=null,$resultType=ResultType::ObjectType){
        $arrayResult=array();
         $zip = $filters['zip'];
            unset($filters['zip']);

         $qb = $this->getQB();
         $qb->join('groups.address', 'address');
         $qb->andWhere('address.zip = :zip')->setParameter('zip', $zip);

         $response= $this->filterQB($qb, array(), ResultType::ObjectType);
             //    var_dump(count($response));die;
     
         $arrayResult=array_merge($arrayResult,$response);

      //return $arrayResult;
       
        $usa='us';
        $result =(array)Zippopotamus::nearby($usa, $zip);
            $areas= Array(); 
              $nearby = array();
              $array=(array)$result['nearby'];
           foreach ($array as $key => $area) {
            $el = (array)$area;
             $nearby[$key]=$el['distance'];
             $array[$key]=$el;
            //$areas[]=$area['nearby'];
                  }
        array_multisort($nearby, SORT_ASC, $array);

        $myarray = (array)$array;

         foreach ($myarray as $key => $value) {
         $qb = $this->getQB();
         $qb->join('groups.address', 'address');
         $qb->andWhere('address.zip = :zip')->setParameter('zip', $value['post code']);
       //  var_dump($value['post code']);die;
     
         $response= $this->filterQB($qb, $filters, ResultType::ObjectType);
         $arrayResult=array_merge($arrayResult,$response);
         }

         return $arrayResult;
         
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
     
        public function returnMemberID($filters = array(),$order=null,$resultType=ResultType::ObjectType){
         $qb = $this->getQB();
        $qb->join('groups.member', 'member')
           ->join('member.user', 'user');
         $qb->andWhere('user.id = :user')->setParameter('user', $filters['user']);
         $qb->andWhere('groups.id = :group')->setParameter('group', $filters['group']);
         if (count($qb->getQuery()->getResult())>0)
            return $qb->getQuery()->getSingleResult()->getId();
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

        //this function list all groups as follower or following where user is subscribed
        public function byMemberSubscribed($filters = array(),$order=null,$resultType=ResultType::ObjectType){
         $qb = $this->getQB();
           
        $qb->join('groups.member', 'member')
           ->join('member.user', 'user');
         
         $qb->andWhere('user.id = :user')->setParameter('user', $filters['user']);
        
         unset($filters['user']);
         unset($filters['group']);
         
         return $this->filterQB($qb, $filters, ResultType::ArrayType);
     }
   
}
