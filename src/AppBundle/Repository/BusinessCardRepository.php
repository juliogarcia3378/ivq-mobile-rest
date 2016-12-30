<?php

namespace AppBundle\Repository;

use Core\ComunBundle\Util\ResultType;
use Core\ComunBundle\Util\Util;
use Doctrine\ORM\Mapping as ORM;
use Core\ComunBundle\Enums\ENotification;
use AppBundle\Entity\Notification;

class BusinessCardRepository extends \Core\ComunBundle\Util\NomencladoresRepository
{

	public function shareBCardRequest($myMember,$bcard,$members){
        $em = $this->getEntityManager();

	 	 foreach ($members as $key => $value) {
	 	 	$notification = new Notification();
             //var_dump($value);die;
            $notification->setMember($em->getRepository("AppBundle:Member")->find($value));
            $notification->setOtherMember($myMember);
            //$notification->setPicture("");
            $notification->setBusinessCard($bcard);
            $notification->setNotificationType($em->getRepository("AppBundle:NotificationType")->find(ENotification::SHARE_B_CARD));
            $em->persist($notification);
	 	 }
	 	 $em->flush();
	 	 
            return "You has sent your Business Card.";
	 }
   
}
