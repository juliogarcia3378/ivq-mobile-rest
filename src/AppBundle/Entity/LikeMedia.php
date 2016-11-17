<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="likeMedia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LikeRepository")
 */
class LikeMedia
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="like_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * @var \AppBundle\Entity\MediaEvent
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MediaEvent",inversedBy="likeMedia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mediaevent", referencedColumnName="id")
     * })

     */
       private $mediaEvent;

  
  
 /**
     * @var \AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="like")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
       private $user;

    /**
     * @var string
     * @ORM\Column(name="date", type="datetime",  nullable=false)
     * @Assert\NotBlank(message="Date required field")
     */
    private $date;


 
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
     * Get event
     * @return \AppBundle\Entity\MediaEvent
     */
    public function getMediaEvent()
    {
        return $this->mediaEvent;
    }
 
         /**
     * Set Event
     * @param \AppBundle\Entity\MediaEvent $event
     * @return Event
     */
    public function setMediaEvent(\AppBundle\Entity\MediaEvent $mediaevent = null)
    {
        $this->mediaEvent = $mediaevent;

        return $this;
    }

        /**
     * Get user
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
 
         /**
     * Set user
     * @param \AppBundle\Entity\User $user
     * @return user
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

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
     * Get date
     *
     * @return string 
     */
    public function getDate()
    {
        return $this->date;
    }


    public function __toString(){
        return $this->getUser()->getId();
    }

      


}
