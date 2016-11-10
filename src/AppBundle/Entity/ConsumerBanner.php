<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 
 *
 * @ORM\Table(name="consumer_banner")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ConsumerRepository")
 */
class ConsumerBanner
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="consumer_banner_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=250, nullable=false)
     * @Assert\NotBlank(message="Name field required")
     */
    private $title;


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
     * @ORM\Column(name="logo", type="text",  nullable=false)
     * @Assert\NotBlank(message="Logo field required")
     */
    private $logo;


  
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
        return $this->logo;
    }



}
