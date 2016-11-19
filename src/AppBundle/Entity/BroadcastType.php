<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="broadcastType")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BroadCastRepository")
 */
class BroadcastType
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="broadcast_type_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Broadcast",mappedBy="broadcastType",cascade={"persist","remove"})
     */
    private $broadcast;
  
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
         $this->broadcast = new \Doctrine\Common\Collections\ArrayCollection();
    }
     /**
     * Add Member
     *
     * @param \AppBundle\Entity\Broadcast $broadcast
     * @return Broadcast
     */
    public function addBroadCast(\AppBundle\Entity\Broadcast $broadcast)
    {
        $this->broadcast[] = $broadcast;
    
        return $this;
    }

     /**
     * Remove Broadcast
     *
     * @param \AppBundle\Entity\Broadcast $broadcast
     */
    public function removeBroadcast(\AppBundle\Entity\Broadcast $broadcast)
    {
        $this->broadcast->removeElement($broadcast);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBroadcast()
    {
        return $this->broadcast;
    }



}
