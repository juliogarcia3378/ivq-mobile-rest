<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CommentRepository")
 */
class Comment
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="comment_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



    /**
     * @var \AppBundle\Entity\Media
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Media",inversedBy="comments")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media", referencedColumnName="id",onDelete="CASCADE")
     * })

     */
       private $media;

  
  
 /**
     * @var \AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="comment")
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


    /**
     * @var string
     * @ORM\Column(name="comment", type="text", nullable=false)
     */
    private $comment;




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
     * @return \AppBundle\Entity\Media
     */
    public function getMedia()
    {
        return $this->media;
    }
 
         /**
     * Set Event
     * @param \AppBundle\Entity\Media $event
     * @return Event
     */
    public function setMedia(\AppBundle\Entity\Media $media = null)
    {
        $this->media = $media;

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

     /**
     * Set foto
     *
     * @param string $date
     * @return Comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get date
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    public function __toString(){
        return $this->getComment();
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

    

      


}
