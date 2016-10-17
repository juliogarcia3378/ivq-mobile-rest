<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;

class UsuarioRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
    public function listAllFiltered($filters = array(),$order=null,$resultType=ResultType::ObjectType){
        $qb = $this->getQB();
        if(array_key_exists('nombre',$filters) && $filters['nombre'] != null) {
            $param = Util::makeCanonic($filters['nombre']);
            $qb->andWhere('usuario.canonic_name like :nombre')
                ->setParameter('nombre',"%$param%")
                /*->setParameter('apellidos',"%$param%")*/;
        }
        /*if(is_array($order) && array_key_exists('nombre',$order)) {
            $order[]=array('apellidos'=>$order[1]);
        }*/
        return $this->filterQB($qb,$filters,$resultType,$order);
    }
        public function listAllAdmin($filters = array(),$order=null,$resultType=ResultType::ArrayType){
     $users=$this->findAll();
     $admin= array();
     foreach ($users as $user) {
        if ($user->isAdmin())
             $admin[]=$user;
     }
        return $admin;
    }


    public function listAllAdvertiser($filters = array(),$order=null,$resultType=ResultType::ObjectType){
        $qb = $this->getQB();
        if(array_key_exists('name',$filters) && $filters['name'] != null) {
            $param = Util::makeCanonic($filters['name']);
            $qb->andWhere('usuario.canonic_name like :name')
                ->setParameter('nombre',"%$param%");
        }
     $users=$this->filterQB($qb,$filters,$resultType,$order);

     $admin= array();
     foreach ($users as $key => $value) {
        if ($value->isAdvertiser())
            $admin[]=$value;
     }

        return $admin;
    }

    public function listAllMembers($filters = array(),$order=null,$resultType=ResultType::ObjectType){
        $qb = $this->getQB();
        if(array_key_exists('name',$filters) && $filters['name'] != null) {
            $param = Util::makeCanonic($filters['name']);
            $qb->andWhere('usuario.canonic_name like :name')
                ->setParameter('nombre',"%$param%");
        }
     $users=$this->filterQB($qb,$filters,$resultType,$order);

     $members= array();
     foreach ($users as $key => $value) {
        if ($value->isMember())
            $members[]=$value;
     }

        return $members;
    }
     public function findUserByMobile($filters = array(),$order=null,$resultType=ResultType::ObjectType){
         $qb = $this->getQB();
        $qb->join('user.profile', 'profile');
         $qb->andWhere('profile.phone = :phone')->setParameter('phone', $filters['mobile']);
         unset($filters['mobile']);
         return $this->filterQB($qb, $filters, ResultType::ObjectType);
     }

}
