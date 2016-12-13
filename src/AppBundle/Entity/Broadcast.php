<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="broadcast")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BroadcastRepository")
 */
class Broadcast
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="member_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Groups
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Groups",inversedBy="broadcast")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="groups", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
    private $groups;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     * @Assert\NotBlank(message="Name field required")
     */
    private $name;



    /**
     * @var string
     * @ORM\Column(name="description", type="text",  nullable=true)
     * @Assert\NotBlank(message="Description field required")
     */
    private $description;


    /**
     * @var string
     * @ORM\Column(name="date", type="datetime",  nullable=false)
     * @Assert\NotBlank(message="Date required field")
     */
    private $date;

        /**
     * @var string
     * @ORM\Column(name="status", type="boolean",  nullable=false)
     */
    private $status;

          /**
     * @var AppBundle\Entity\Advertiser
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Advertiser",inversedBy="broadcast")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="advertiser", referencedColumnName="id",nullable=true, onDelete="CASCADE")
     * })
     */
       private $advertiser;
       
        /**
     * @var AppBundle\Entity\BroadcastType
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BroadcastType",inversedBy="broadcast")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="broadcastType", referencedColumnName="id",nullable=true, onDelete="CASCADE")
     * })
     */
       private $broadcastType;


      /**
     * @var \Users
     *
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Survey",mappedBy="broadcast")
     */
    private $survey;
  


         /**
     * @var \AppBundle\Entity\Media
     * @ORM\OneToOne(targetEntity="Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media", referencedColumnName="id",nullable=true,onDelete="CASCADE")
     * })
     */
      private $media;

     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\likeBroadcast",mappedBy="likeBroadcast",cascade={"persist","remove"})
     */
    private $likeBroadcast;
  


    public function __construct()
    {
        $this->likeBroadcast = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Get format
     *
     * @return string
     */
    public function getFormat()
    {
        return $this->media->getFormat();
    }

        /**
     * Set title
     *
     * @param string $format
     *
     * @return Group
     */
    public function setFormat($format)
    {
        $this->media->setFormat($format);
    
        return $this;
    }


    /**
     * Set title
     *
     * @param string $title
     *
     * @return Group
     */
    public function setName($title)
    {
        $this->name = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

        /**
     * Set description
     *
     * @param string $description
     *
     * @return Broadcast
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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
     * Set URL
     *
     * @param string $url
     * @return Broadcast
     */
    public function setURL($url)
    {
        $this->media->setUrl($url);

        return $this;
    }
    /**
     * Get URL
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->media->getPath();
    }
    /**
     * Get URL
     *
     * @return string 
     */
    public function getURL()
    {
        return $this->media->getPath();
    }
      
    /**
     * Set URL
     *
     * @param string $url
     * @return Broadcast
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get URL
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

                /**
     * Get group
     *
     * @return \Core\MySecurityBundle\Entity\BroadcastType
     */
    public function getBroadcastType()
    {
        return $this->broadcastType;
    }
 
         /**
     * Set User
     *
     * @param \AppBundle\Entity\BroadcastType $user
     *
     * @return User
     */
    public function setBroadcastType(\AppBundle\Entity\BroadcastType $broadcastType = null)
    {
        $this->broadcastType = $broadcastType;

        return $this;
    }
    
                /**
     * Get advertiser
     *
     * @return \AppBundle\Entity\Advertiser
     */
    public function getAdvertiser()
    {
        return $this->advertiser;
    }
 
         /**
     * Set advertiser
     *
     * @param \AppBundle\Entity\Advertiser $advertiser
     *
     * @return advertiser
     */
    public function setAdvertiser(\AppBundle\Entity\Advertiser $advertiser = null)
    {
        $this->advertiser = $advertiser;

        return $this;
    }


    /**
     * Set User
     *
     * @param string $user
     * @return Survey
     */
    public function setSurvey(\AppBundle\Entity\Survey $survey)
    {
        $this->survey= $survey;

        return $this;
    }

    /**
     * Get namee
     *
     * @return string
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    /**
     * Set User
     *
     * @param string $user
     * @return Survey
     */
    public function setMedia(\AppBundle\Entity\Media $media)
    {
        $this->media= $media;

        return $this;
    }

    /**
     * Get namee
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }


               /**
     * Add Following
     *
     * @param \AppBundle\Entity\LikeBroadcast $Following
     * @return Follow
     */
    public function addLikeBroadcast(\AppBundle\Entity\LikeBroadcast $likeBroadcast)
    {
        $this->likeBroadcast[] = $likeBroadcast;
    
        return $this;
    }

     /**
     * Remove following
     *
     * @param \AppBundle\Entity\LikeBroadcast $following
     */
    public function removeLikeBroadcast(\AppBundle\Entity\LikeBroadcast $likeBroadcast)
    {
        $this->likeBroadcast->removeElement($likeBroadcast);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLikeBroadcast()
    {
        return $this->likeBroadcast;
    }


}
