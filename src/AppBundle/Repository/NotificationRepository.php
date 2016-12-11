<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Core\ComunBundle\Util\UtilRepository2;
use Core\ComunBundle\Enums\ENotification;


class NotificationRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{
  
  public function byUser($filters=array()){
     $em = $this->getEntityManager();
     $qb = $em->createQueryBuilder();
        $qb->select('n')
       ->from('AppBundle:Notification', 'n')
       ->join('n.member', 'm')
       ->join('m.user', 'u')
         ->where('u.id = :user')
         ->setParameter('user', $filters["user"]);
        $notifications= $qb->getQuery()->getResult();

        $response= array();
        $array = array();
        foreach ($notifications as $key => $notification) {
            $array["id"]=$notification->getId();
            $array["type"]["text"]=$notification->getNotificationType()->getName();
            if (ENotification::ATTEND_TO_EVENT==$notification->getNotificationType()->getId()){
                $event=$notification->getEvent();
                $array["event"]["id"]=$event->getId();
                $array["event"]["name"]=$event->getName();
                $array["event"]["logo"]=$event->getLogo();
                $array["member"]["id"]="";
                $array["member"]["name"]="";
                $array["member"]["avatar"]="";
            }else
            {
                $array["member"]["id"]=$notification->getOtherMember()->getId();
                $array["member"]["name"]=$notification->getOtherMember()->getUser()->getProfile()->getFullname();
                $array["member"]["avatar"]=$notification->getOtherMember()->getUser()->getProfile()->getAvatar();
            }
            $array["type"]["id"]=$notification->getNotificationType()->getId();
            $array["picture"]=$notification->getPicture();
            $response[]=$array;
            
        }

        return $response;

  }
   
}
