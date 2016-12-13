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
     *   @ORM\JoinColumn(name="user", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
       private $user;

     /**
     * @var \AppBundle\Entity\EMedia
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EMedia",inversedBy="media")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="mediaType", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
       private $mediaType;

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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\MediaEvent",mappedBy="media",cascade={"persist","remove"})
     */
    private $mediaEvent;

        /**
     * @var \Users
     *
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Broadcast",mappedBy="media")
     */
    private $broadcast;

     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Comment",mappedBy="media",cascade={"persist","remove"})
     */
    private $comments;

     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\LikeMedia",mappedBy="media",cascade={"persist","remove"})
     */
    private $likeMedia;


     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Profile",mappedBy="avatar",cascade={"persist","remove"})
     */
    private $profile;



  public function __construct()
    {
        $this->comments = new \Doctrine\Common\Collections\ArrayCollection();
        $this->likeMedia = new \Doctrine\Common\Collections\ArrayCollection();
        $this->profile = new \Doctrine\Common\Collections\ArrayCollection();


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
         if ($this->url==null)
	return "";
        return $this->url;
    }

        /**
     * Set url
     *
     * @param string $url
     *
     * @return url
     */
    public function setMediaType(\AppBundle\Entity\EMedia $mediaType)
    {
        $this->mediaType = $mediaType;
    
        return $this;
    }

    /**
     * Get url
     *
     * @return url
     */
    public function getMediaType()
    {
        return $this->mediaType;
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
        return $this->getUrl();
    }

     /**
     * Add Media
     *
     * @param \AppBundle\Entity\MediaEvent $media
     * @return Media
     */
    public function setMediaEvent(\AppBundle\Entity\MediaEvent $mediaEvent)
    {
        $this->mediaEvent = $mediaEvent;
        return $this;
    }



    /**
     * Get Member
     *
     */
    public function getMediaEvent()
    {
        return $this->mediaEvent;
    }

               /**
     * Add Following
     *
     * @param \AppBundle\Entity\Notification $Following
     * @return Follow
     */
    public function addLikeMedia(\AppBundle\Entity\LikeMedia $likeMedia)
    {
        $this->likeMedia[] = $likeMedia;
    
        return $this;
    }

     /**
     * Remove following
     *
     * @param \AppBundle\Entity\LikeMedia $following
     */
    public function removeLikeMedia(\AppBundle\Entity\LikeMedia $notification)
    {
        $this->likeMedia->removeElement($notification);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLikeMedia()
    {
        return $this->likeMedia;
    }

              /**
     * Add Comment
     *
     * @param \AppBundle\Entity\Comment $comment
     * @return Media
     */
    public function addComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments[] = $comment;
    
        return $this;
    }

     /**
     * Remove comment
     *
     * @param \AppBundle\Entity\Comment $comment
     */
    public function removeComment(\AppBundle\Entity\Comment $comment)
    {
        $this->comments->removeElement($comment);
    }

    /**
     * Get Comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComment()
    {
        return $this->comments;
    }

    /**
     * Get Comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLikesJSON(){
        $array = array();
        foreach ($this->getLikeMedia() as $key => $likeMedia) {
            $aux['id']=$likeMedia->getMedia()->getId();
            $aux['user']["avatar"]=$likeMedia->getUser()->getProfile()->getAvatar()->getURL();
            $aux['user']["name"]=$likeMedia->getUser()->getProfile()->getFullname();
            $aux['date']=$likeMedia->getDate();
            $array[]=$aux;
        }

        return $array;
    }
      
        /**
     * Get Comment
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCommentsJSON(){
        $array = array();
        foreach ($this->getComment() as $key => $comment) {
            $aux['id']=$comment->getId();
            $aux['user']["avatar"]=$comment->getUser()->getProfile()->getAvatar()->getURL();
            $aux['user']["name"]=$comment->getUser()->getProfile()->getFullname();
            $aux["comment"]=$comment->getComment();
            $aux['date']=$comment->getDate();
            $array[]=$aux;
        }

        return $array;
    }
}
