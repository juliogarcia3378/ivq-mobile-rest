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
     *   @ORM\JoinColumn(name="groups", referencedColumnName="id")
     * })
     */
    private $groups;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=250, nullable=false)
     * @Assert\NotBlank(message="Name field required")
     */
    private $title;

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
     * Set title
     *
     * @param string $title
     *
     * @return Group
     */
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
        $this->url = $url;

        return $this;
    }

    /**
     * Get URL
     *
     * @return string 
     */
    public function getURL()
    {
        return $this->url;
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



}
