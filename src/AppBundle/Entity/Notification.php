<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NotificationRepository")
 */
class Notification
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="notification_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



  
  
 /**
     * @var \AppBundle\Entity\Member
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Member",inversedBy="notification")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="member", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
       private $member;

    /**
     * @var string
     * @ORM\Column(name="date", type="datetime",  nullable=false)
     * @Assert\NotBlank(message="Date required field")
     */
    private $date;


        /**
     * @var \AppBundle\Entity\Media
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Media",inversedBy="mediaEvent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="picture", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
       private $picture;

    /**
    * @var \AppBundle\Entity\Event
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event",inversedBy="event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
       private $event;

    /**
    * @var \AppBundle\Entity\BusinessCard
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BusinessCard",inversedBy="businessCard")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="businessCard", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
       private $businessCard;

    /**
    * @var \AppBundle\Entity\Member
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Member",inversedBy="otherMember")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="otherMember", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
       private $otherMember;

      /**
     * @var AppBundle\Entity\NotificationType
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\NotificationType",inversedBy="notification")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="notificationType", referencedColumnName="id",nullable=true, onDelete="CASCADE")
     * })
     */
       private $notificationType;


 
  public function __construct()
    {
        $this->date = new \DateTime();
    }

  
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
     * Get user
     * @return \AppBundle\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
    }
 
         /**
     * Set user
     * @param \AppBundle\Entity\Member $user
     * @return user
     */
    public function setMember(\AppBundle\Entity\Member $member = null)
    {
        $this->member = $member;

        return $this;
    }


        /**
     * Get user
     * @return \AppBundle\Entity\Member
     */
    public function getOtherMember()
    {
        return $this->otherMember;
    }
 
         /**
     * Set user
     * @param \AppBundle\Entity\Member $user
     * @return user
     */
    public function setOtherMember(\AppBundle\Entity\Member $member = null)
    {
        $this->otherMember = $member;

        return $this;
    }

     /**
     * Set foto
     *
     * @param string $date
     * @return Groups
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

 
         /**
     * Set user
     * @param \AppBundle\Entity\Event $event
     * @return user
     */
    public function setEvent(\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }


        /**
     * Get user
     * @return \AppBundle\Entity\BusinessCard
     */
    public function getBusinessCard()
    {
        return $this->businessCard;
    }

     /**
     * Set user
     * @param \AppBundle\Entity\BusinessCard $b-card
     * @return user
     */
    public function setBusinessCard(\AppBundle\Entity\BusinessCard $businessCard = null)
    {
        $this->businessCard = $businessCard;

        return $this;
    }


        /**
     * Get user
     * @return \AppBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }


     /**
     * Set foto
     *
     * @param string $date
     * @return Groups
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getPicture()
    {    if ($this->picture==null)
        return "";
        return $this->picture;
    }


    public function __toString(){
        return $this->getPicture();
    }

        /**
     * Get user
     * @return \AppBundle\Entity\NotificationType
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }
 
         /**
     * Set user
     * @param \AppBundle\Entity\NotificationType $notificationType
     * @return user
     */
    public function setNotificationType(\AppBundle\Entity\NotificationType $notificationType = null)
    {
        $this->notificationType = $notificationType;

        return $this;
    }
      


}
