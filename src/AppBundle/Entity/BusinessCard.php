<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 
 *
 * @ORM\Table(name="business_card")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusinessCardRepository")
 */
class BusinessCard
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="business_card_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


    /**
     * @var string
     * @ORM\Column(name="title", type="string", length=250, nullable=true)
     * @Assert\NotBlank(message="Name field required")
     */
    private $title;


    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=250, nullable=true)
     * @Assert\NotBlank(message="Name field required")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=250, nullable=true)
     * @Assert\NotBlank(message="Name field required")
     */
    private $lastname;
    
    /**
     * @var \AppBundle\Entity\Address
     *
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Address",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address", referencedColumnName="id",nullable=true, onDelete="CASCADE")
     * })
     */
      private $address;

     /**
     * @var \AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="user")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id",nullable=true, onDelete="CASCADE")
     * })
     */
       private $user;
       
         /**
     * @var \AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\GroupCategory",inversedBy="category")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
       private $category;


    /**
     * @var integer
     * @ORM\Column(name="phone", type="string", length=12, nullable=true)
     * @Assert\NotBlank(message="Phone field Required ")
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=50,  nullable=true)
     * @Assert\NotBlank(message="Email field required")
     */
    private $email;


    /**
     * @var string
     * @ORM\Column(name="company", type="string", length=50,  nullable=true)
     * @Assert\NotBlank(message="Company field required")
     */
    private $company;

        /**
     * @var string
     * @ORM\Column(name="fax", type="string", length=50,  nullable=true)
     * @Assert\NotBlank(message="Fax field required")
     */
    private $fax;


        /**
     * @var string
     * @ORM\Column(name="website", type="string", length=50,  nullable=true)
     * @Assert\NotBlank(message="Website field required")
     */
    private $website;

            /**
     * @var string
     * @ORM\Column(name="notes", type="string", length=50,  nullable=true)
     */
    private $notes;

    /**
     * @var string
     * @ORM\Column(name="about", type="text",  nullable=true)
     */
    private $about;

     /**
     * @var \AppBundle\Entity\Media
     * @ORM\OneToOne(targetEntity="Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="logo", referencedColumnName="id",nullable=true,onDelete="CASCADE")
     * })
     */
    private $logo;


    /**
     * @var \AppBundle\Entity\Media
     * @ORM\OneToOne(targetEntity="Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="picture", referencedColumnName="id",nullable=true,onDelete="CASCADE")
     * })
     */
      private $picture;

    
    /**
     * @var string
     * @ORM\Column(name="finished", type="boolean", nullable=false)
     */
    private $finished;

        /**
     * @var string
     * @ORM\Column(name="saved", type="boolean", nullable=false)
     */
    private $saved;



           /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\BusinessCardMedia",mappedBy="businessCard",cascade={"persist","remove"})
     */
    private $businessCardMedia;

        /**
     * Constructor
     */
    public function __construct()
    {
        $this->businessCardMedia = new \Doctrine\Common\Collections\ArrayCollection();
        $this->saved=false;


    }

         /**
     * Add Media
     *
     * @param \AppBundle\Entity\BusinessCardMedia $like
     * @return Media
     */
    public function addBusinessCardMedia(\AppBundle\Entity\BusinessCardMedia $media)
    {
        $media->setBusinessCard($this);
        $this->businessCardMedia[] = $media;
    
        return $this;
    }

     /**
     * Remove Media
     *
     * @param \AppBundle\Entity\BusinessCardMedia $like_
     */
    public function removeBusinessCardMedia(\AppBundle\Entity\BusinessCardMedia $like_)
    {
        $this->businessCardMedia->removeElement($like_);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBusinessCardMedia()
    {
        return $this->businessCardMedia;
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
          if ($this->name ==null)
            return "";
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Group
     */
    public function setCompany($company)
    {
        $this->company = $company;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getCompany()
    {
          if ($this->company ==null)
            return "";
        return $this->company;
    }

           /**
     * Set name
     *
     * @param string $name
     *
     * @return Group
     */
    public function setFinished($finished)
    {
        $this->finished = $finished;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getFinished()
    {
        return $this->finished;
    }
    

    
           /**
     * Set name
     *
     * @param string $name
     *
     * @return Group
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getLastname()
    {
          if ($this->lastname ==null)
            return "";
        return $this->lastname;
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
          if ($this->title ==null)
            return "";
        return $this->title;
    }

    /**
     * Set phone
     *
     * @param string $phone
     *
     * @return Group
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    
        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
          if ($this->phone ==null)
            return "";
        return $this->phone;
    }

        /**
     * Set email
     *
     * @param string $email
     *
     * @return BusinessCard
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
       if ($this->email ==null)
            return "";
        return $this->email;
    }

  

    /**
     * Set Zip
     *
     * @param string $zip
     * @return BusinessCard
     */
    public function setZip($zip)
    {
        $this->zip = $zip;

        return $this;
    }

    /**
     * Get zip
     *
     * @return string 
     */
    public function getZip()
    {
        return $this->zip;
    }

        /**
     * Set fax
     *
     * @param string $fax
     * @return BusinessCard
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string 
     */
    public function getFax()
    {
          if ($this->fax ==null)
            return "";
        return $this->fax;
    }

    /**
     * Set website
     *
     * @param string $website
     * @return BusinessCard
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }


    /**
     * Get website
     *
     * @return string 
     */
    public function getWebsite()
    {
          if ($this->website ==null)
            return "";
        return $this->website;
    }

    /**
     * Get notes
     *
     * @return string 
     */
    public function getNotes()
    {
          if ($this->notes ==null)
            return "";
        return $this->notes;
    }

        /**
     * Set notes
     *
     * @param string $notes
     * @return BusinessCard
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;

        return $this;
    }

     /**
     * Get about
     *
     * @return string 
     */
    public function getAbout()
    {
        if ($this->about ==null)
            return "";
        return $this->about;
    }

        /**
     * Set notes
     *
     * @param string $about
     * @return BusinessCard
     */
    public function setAbout($about)
    {
        $this->about = $about;

        return $this;
    }
     /* Set saved
     *
     * @param string $name
     *
     * @return Group
     */
    public function setSaved($saved)
    {
        $this->saved = $saved;
    
        return $this;
    }

     /* Set saved
     *
     * @param string $name
     *
     * @return Group
     */
    public function getSaved()
    {
        return $this->saved;
    }
      
            /**
     * Set foto
     *
     * @param string $logo
     * @return Groups
     */
    public function setLogo(\AppBundle\Entity\Media $logo)
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
        if ($this->logo ==null)
            return "";
        return $this->logo;
    }


            /**
     * Set foto
     *
     * @param string $picture
     * @return Groups
     */
    public function setPicture(\AppBundle\Entity\Media $picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getPicture()
    {     if ($this->picture ==null)
            return "";
        return $this->picture;
    }
     
         /**
     * Set category
     *
     * @param \AppBundle\Entity\GroupCategory $category
     *
     * @return Groups
     */
    public function setCategory(\AppBundle\Entity\GroupCategory $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\GroupCategory
     */
    public function getCategory()
    {
        return $this->category;
    }

        /**
     * Set user
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
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    
            /**
     * Set user
     *
     * @param \AppBundle\Entity\Address $address
     *
     * @return User
     */
    public function setAddress(\AppBundle\Entity\Address $address = null)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\Address
     */
    public function getAddress()
    {
        return $this->address;
    }



}

