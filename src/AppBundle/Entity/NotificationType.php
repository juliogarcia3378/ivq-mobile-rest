<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="notificationType")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NotificationRepository")
 */
class NotificationType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="notification_type_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;




     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Notification",mappedBy="notificationType",cascade={"persist","remove"})
     */
    private $notification;
  
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set code
     *
     * @param string $state_code
     * @return Menu
     */
    public function setName($name)
    {
        $this->name= $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }


    public function __construct()
    {
         $this->notificacion = new \Doctrine\Common\Collections\ArrayCollection();
    }
     /**
     * Add Member
     *
     * @param \AppBundle\Entity\Notification $notification
     * @return Broadcast
     */
    public function addNotification(\AppBundle\Entity\Notification $notification)
    {
        $this->notification[] = $notification;
    
        return $this;
    }

     /**
     * Remove Broadcast
     *
     * @param \AppBundle\Entity\Notification $notification
     */
    public function removeNotification(\AppBundle\Entity\Notification $notification)
    {
        $this->notification->removeElement($notification);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotification()
    {
        return $this->notification;
    }



}
