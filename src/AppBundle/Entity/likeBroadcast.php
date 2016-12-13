<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="like_broadcast")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LikeBroadcastRepository")
 */
class likeBroadcast
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="like_broadcast_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * @var \AppBundle\Entity\Broadcast
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Broadcast",inversedBy="likeBroadcast")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="broadcast", referencedColumnName="id",onDelete="CASCADE")
     * })

     */
       private $broadcast;

  
  
 /**
     * @var \AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="like")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id",onDelete="CASCADE")
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
    public function getBroadcast()
    {
        return $this->broadcast;
    }
 
         /**
     * Set Event
     * @param \AppBundle\Entity\Broadcast $broadcast
     * @return Broadcast
     */
    public function setBroadcast(\AppBundle\Entity\Broadcast $broadcast = null)
    {
        $this->broadcast = $broadcast;

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
        return "";
    }

      


}
