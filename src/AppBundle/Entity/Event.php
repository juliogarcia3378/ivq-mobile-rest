<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EventRepository")
 */
class Event
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="event_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

     /**
     * @var string
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Required field")
     */
    private $name;
    
    /**
     * @var string
     * @ORM\Column(name="paid_event", type="boolean", nullable=true)
     */
    private $paid_event;

    /**
     * @var string
     * @ORM\Column(name="finish", type="datetime",  nullable=true)
     * @Assert\NotBlank(message="Date required field")
     */
    private $finish_date;

      /**
     * @var \Address
     *
     * @ORM\OneToOne(targetEntity="Address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     * })
     */
    private $address;


   /**
     * @var string
     * @ORM\Column(name="ticket_url", type="text",  nullable=true)
     * @Assert\NotBlank(message="Required field")
     */
    private $ticket_url;

     

    /**
     * @var string
     * @ORM\Column(name="information", type="text",  nullable=false)
     * @Assert\Email
     * @Assert\NotBlank(message="Email required field")
     */
    private $information;

        /**
     * @var string
     * @ORM\Column(name="date", type="datetime",  nullable=false)
     * @Assert\NotBlank(message="Date required field")
     */
    private $date;

            /**
     * @var string
     * @ORM\Column(name="updated_at", type="datetime",  nullable=false)
     * @Assert\Email
     * @Assert\NotBlank(message="Date required field")
     */
    private $updated_at;


    /**
     * @var string
     * @ORM\Column(name="website", type="string", length=250, nullable=true)
     * @Assert\Email
     * @Assert\NotBlank(message="Website field required")
     */
    private $website;





     /**
     * @var \AppBundle\Entity\Media
     * @ORM\OneToOne(targetEntity="Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     * })
     */
      private $logo;

    /**
     * @var string
     * @ORM\Column(name="price", type="text",  nullable=false)
     * @Assert\NotBlank(message="Price field required")
     */
    private $price;

    /**
     * @var \AppBundle\Entity\Groups
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Groups",inversedBy="event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="groups", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $groups;

     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MediaEvent",mappedBy="event",cascade={"persist","remove"})
     */
    private $mediaEvent;

         /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Notification",mappedBy="event",cascade={"persist","remove"})
     */
    private $notification;

     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\likeEvent",mappedBy="likeEvent",cascade={"persist","remove"})
     */
    private $likeEvent;
  


    public function __construct()
    {
        $this->likeEvent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->mediaEvent = new \Doctrine\Common\Collections\ArrayCollection();
        $this->notification = new \Doctrine\Common\Collections\ArrayCollection();


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
     * Set name
     *
     * @param string $name
     *
     * @return Group
     */
    public function setName($name)
    {
        $this->name = $name;
    
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

        /**
     * Set name
     *
     * @param string $name
     *
     * @return Group
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }


        /**
     * Set paid_event
     *
     * @param string $paid_event
     *
     * @return Group
     */
    public function setPaidevent($paid)
    {
        $this->paid_event = $paid;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getPaidevent()
    {  
        if ($this->paid_event==null)
        return false;
        return $this->paid_event;
    }


    /**
     * Set address
     *
     * @param string $address
     *
     * @return Group
     */
    public function setAddress($address)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

   

    /**
     * Set phone
     *
     * @param string $price
     *
     * @return Event
     */
    public function setTicketURL($ticketURL)
    {
        $this->ticket_url = $ticketURL;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getTicketURL()
    {
         if ($this->ticket_url==null)
        return "";
        return $this->ticket_url;
    }

    /**
     * Set information
     *
     * @param string $information
     *
     * @return Group
     */
    public function setInformation($information)
    {
        $this->information = $information;
    
        return $this;
    }

    /**
     * Get information
     *
     * @return string
     */
    public function getInformation()
    {  
        if ($this->information==null)
        return "";
        return $this->information;
    }


    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
         if ($this->website==null)
        return "";
        return $this->website;
    }

    /**
     * Set address
     *
     * @param string $website
     *
     * @return WebSite
     */
    public function setWebsite($website)
    {
        $this->website = $website;
    
        return $this;
    }


    /**
     * Set groups
     *
     * @param \AppBundle\Entity\Groups $groups
     *
     * @return Groups
     */
    public function setGroups(\AppBundle\Entity\Groups $groups = null)
    {
        $this->group = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return \AppBundle\Entity\Groups
     */
    public function getGroups()
    {
        return $this->groups;
    }

        /**
     * Set foto
     *
     * @param string $logo
     * @return Groups
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getLogo()
    {
       if ($this->logo==null)
            return "";
        return $this->logo;
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


        /**
     * Set foto
     *
     * @param string $updated_at
     * @return Event
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

     /**
     * Add MediaEvent
     *
     * @param \AppBundle\Entity\MediaEvent $media
     * @return MediaEvent
     */
    public function addMediaEvent(\AppBundle\Entity\MediaEvent $mediaEvent)
    {
        $this->mediaEvent[] = $mediaEvent;
        return $this;
    }

     /**
     * Remove MediaEvent
     *
     * @param \AppBundle\Entity\MediaEvent $mediaEvent
     */
    public function removeMediaEvent(\AppBundle\Entity\MediaEvent $mediaEvent)
    {
        $this->mediaEvent->removeElement($mediaEvent);
    }

    /**
     * Get MediaEvent
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMediaEvent()
    {
        return $this->mediaEvent;
    }

     /**
     * Add MediaEvent
     *
     * @param \AppBundle\Entity\Notification $media
     * @return MediaEvent
     */
    public function addNotification(\AppBundle\Entity\Notification $notification)
    {
        $this->notification[] = $notification;
        return $this;
    }

     /**
     * Remove MediaEvent
     *
     * @param \AppBundle\Entity\Notification $notification
     */
    public function removeNotification(\AppBundle\Entity\Notification $notification)
    {
        $this->notification->removeElement($notification);
    }

    /**
     * Get Notification
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getNotification()
    {
        return $this->notification;
    }


               /**
     * Add Following
     *
     * @param \AppBundle\Entity\LikeEvent $likeEvent
     * @return Follow
     */
    public function addLikeEvent(\AppBundle\Entity\LikeEvent $likeEvent)
    {
        $this->likeEvent[] = $likeEvent;
    
        return $this;
    }

     /**
     * Remove following
     *
     * @param \AppBundle\Entity\LikeEvent $following
     */
    public function removeLikeEvent(\AppBundle\Entity\LikeEvent $likeEvent)
    {
        $this->likeEvent->removeElement($likeEvent);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLikeEvent()
    {
        return $this->likeEvent;
    }


}

