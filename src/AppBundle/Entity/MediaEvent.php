<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="media_event")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MediaEventRepository")
 */
class MediaEvent
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="mediaevent_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

  

 

    /**
     * @var \AppBundle\Entity\Event
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Event",inversedBy="mediaEvent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="event", referencedColumnName="id")
     * })

     */
       private $event;

    /**
     * @var \AppBundle\Entity\Media
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Media",inversedBy="mediaEvent")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media", referencedColumnName="id")
     * })
     */
       private $media;

    /**
     * @var string
     * @ORM\Column(name="date", type="datetime",  nullable=false)
     * @Assert\NotBlank(message="Date required field")
     */
    private $date;

    /**
     * @var string
     * @ORM\Column(name="comment", type="text",  nullable=false)
     * @Assert\NotBlank(message="Name field required")
     */
    private $comment;


  /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment",mappedBy="mediaEvent",cascade={"persist","remove"})
     */
    private $comments;

           /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LikeMedia",mappedBy="mediaEvent",cascade={"persist","remove"})
     */
    private $likemedia;





  public function __construct()
    {
        $this->date = new \DateTime();
        $this->likemedia = new \Doctrine\Common\Collections\ArrayCollection();
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();


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
     * @return \AppBundle\Entity\Event
     */
    public function getEvent()
    {
        return $this->event;
    }
 
         /**
     * Set Event
     * @param \AppBundle\Entity\Event $event
     * @return Event
     */
    public function setEvent(\AppBundle\Entity\Event $event = null)
    {
        $this->event = $event;

        return $this;
    }


        /**
     * Get event
     * @return \AppBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
 
         /**
     * Set Event
     * @param \AppBundle\Entity\Media $media
     * @return Media
     */
    public function setMedia(\AppBundle\Entity\Media $media = null)
    {
        $this->media = $media;

        return $this;
    }


     /**
     * Add Like_
     *
     * @param \AppBundle\Entity\LikeMedia $media
     * @return Like_
     */
    public function addLikeMedia(\AppBundle\Entity\LikeMedia $like_)
    {
        $this->likemedia[] = $like_;
        return $this;
    }

     /**
     * Remove Like_
     *
     * @param \AppBundle\Entity\LikeMedia $like
     */
    public function removeLikeMedia(\AppBundle\Entity\LikeMedia $like_)
    {
        $this->likemedia->removeElement($like_);
    }

    /**
     * Get Like
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLikeMedia()
    {
        return $this->likemedia;
    }

    
        /**
     * Get date
     */
    public function getDate()
    {
        return $this->date;
    }
 
         /**
     * Set Date
     * @return this
     */
    public function setDate($date = null)
    {
        $this->date = $date;

        return $this;
    }

      /**
     * Get date
     */
    public function getComment()
    {
        return $this->comment;
    }
 
         /**
     * Set Date
     * @return this
     */
    public function setComment($comment = null)
    {
        $this->comment = $comment;

        return $this;
    }


     /**
     * Add Like_
     *
     * @param \AppBundle\Entity\Comment $comment
     * @return Comment
     */
    public function addComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;
        return $this;
    }

     /**
     * Remove Comment
     *
     * @param \AppBundle\Entity\Comment $comment
     */
    public function removeComment(\AppBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get Like
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }


      
}
