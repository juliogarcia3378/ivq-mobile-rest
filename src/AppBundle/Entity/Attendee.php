<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="attendee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AttendeeRepository")
 */
class Attendee
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="attendee_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


      /**
     * @var \AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="attendee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
       private $user;

  
      /**
     * @var \AppBundle\Entity\Event
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event",inversedBy="attendee")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event", referencedColumnName="id")
     * })
     */
       private $event;

  
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
     * Get group
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
 
         /**
     * Set User
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return User
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }
            /**
     * Get Event
     *
     * @return \AppBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }
 
         /**
     * Set User
     *
     * @param \AppBundle\Entity\Event $event
     *
     * @return Event
     */
    public function setEvent(\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }

    
    public function __toString(){
        return $this->getUser()->getId();
    }

      


}
