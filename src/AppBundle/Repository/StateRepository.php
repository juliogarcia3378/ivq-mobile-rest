<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;

class StateRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{

	  public function orderZipByState($filters = array(),$order=null,$resultType=ResultType::ObjectType){

        $qb = $this->getQB();
        $qb->join('state.address', 'address');
        if ($filters["zip"]!=null)
        $qb->andWhere('address.zip = :zip')->setParameter('zip', $filters['zip']);
        
        unset($filters['zip']);
        return $this->filterQB($qb, $filters, ResultType::ObjectType);
      }
   
}
