<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="media")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MediaRepository")
 */
class Media
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="media_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

  
 /**
     * @var \AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
       private $user;

           /**
     * @var string
     * @ORM\Column(name="format", type="string", length=250, nullable=false)
     * @Assert\NotBlank(message="Name field required")
     */
    private $format;

    /**
     * @var string
     * @ORM\Column(name="url", type="string", length=250, nullable=false)
     * @Assert\NotBlank(message="URL field required")
     */
    private $url;

     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MediaEvent",mappedBy="media",cascade={"persist","remove"})
     */
    private $mediaEvent;



  public function __construct()
    {
        $this->mediaEvent = new \Doctrine\Common\Collections\ArrayCollection();


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
        return $this->format;
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
        $this->format = $format;
    
        return $this;
    }


    /**
     * Set url
     *
     * @param string $url
     *
     * @return url
     */
    public function setURL($url)
    {
        $this->url = $url;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return url
     */
    public function getURL()
    {
        return $this->url;
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
     * @return Groups
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    


    public function __toString(){
        return $this->getUser()->getId();
    }

     /**
     * Add Media
     *
     * @param \AppBundle\Entity\MediaEvent $media
     * @return Media
     */
    public function addMediaEvent(\AppBundle\Entity\MediaEvent $mediaEvent)
    {
        $this->mediaEvent[] = $mediaEvent;
        return $this;
    }

     /**
     * Remove Media
     *
     * @param \AppBundle\Entity\MediaEvent $mediaEvent
     */
    public function removeMediaEvent(\AppBundle\Entity\MediaEvent $mediaEvent)
    {
        $this->mediaEvent->removeElement($mediaEvent);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMediaEvent()
    {
        return $this->mediaEvent;
    }

      
}
