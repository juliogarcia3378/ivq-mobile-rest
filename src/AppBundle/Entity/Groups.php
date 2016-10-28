<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * @ORM\Table(name="groups")
 * @ORM\Entity(repositoryClass="\AppBundle\Repository\GroupRepository")
 */
class Groups
{

        /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="mgroup_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\Column(name="description", type="text",  nullable=true)
     */
     private $description;


      /**
     * @var \AppBundle\Entity\Address
     *
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Address",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="address", referencedColumnName="id",nullable=false)
     * })
     */
      private $address;


   /**
     * @var string
     * @ORM\Column(name="phone", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Required field")
     */
   private $phone;

    /**
     * @var string
     * @ORM\Column(name="email", type="string", length=50, nullable=false)
     * @Assert\Email
     * @Assert\NotBlank(message="Email required field")
     */
    private $email;

    /**
     * @var string
     * @ORM\Column(name="website", type="string", length=250, nullable=false)
     * @Assert\Email
     * @Assert\NotBlank(message="Website field required")
     */
    private $website;

        /**
     * @var string
     * @ORM\Column(name="logo", type="text", nullable=true)
     */
        private $logo;

    /**
     * @var \AppBundle\Entity\GroupCategory
     *
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\GroupCategory",inversedBy="groups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id")
     * })
     */
    private $category;

        /**
     * @var \Event
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Event", mappedBy="groups", cascade={"persist","remove"})
     */
        private $event;

     /**
     * @var \member
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Member", mappedBy="groups", cascade={"persist","remove"})
     */
        private $member;


            /**
    * @var \Groups
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Coupon", mappedBy="groups", cascade={"persist","remove"})
     */
            private $coupon;

    /**
    * @Assert\File(maxSize="6000000")
    */
    private $file;

    
    /**
     * Constructor
     */
    public function __construct()
    {
         $this->member = new \Doctrine\Common\Collections\ArrayCollection();
         $this->coupon = new \Doctrine\Common\Collections\ArrayCollection();
         $this->event = new \Doctrine\Common\Collections\ArrayCollection();

    }


    public function getAbsolutePath()
    {
        return null === $this->logo ? null : $this->getUploadRootDir().'/'.$this->logo;
    }

    public function getWebPath()
    {
        return null === $this->logo ? null : $this->getUploadDir().'/'.$this->logo;
    }

    protected function getUploadRootDir()
    {
// the absolute directory path where uploaded
// documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        return 'uploads/documents';
    }
    
    public function upload()
    {

// the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }
// use the original file name here but you should
// sanitize it at least to avoid any security issues
// move takes the target directory and then the
// target filename to move to
        $this->getFile()->move(
            $this->getUploadRootDir(),
            $this->getFile()->getClientOriginalName()
            );
// set the path property to the filename where you've saved the file
        $this->logo = $this->getFile()->getClientOriginalName();
// clean up the file property as you won't need it anymore
        $this->file = null;


    }


        /**
        * Sets file.
        *
        * @param UploadedFile $file
        */
        public function setFile(UploadedFile $file = null)
        {
            $this->file = $file;
        }
        /**
        * Get file.
        *
        * @return UploadedFile
        */
        public function getFile()
        {
            return $this->file;
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
        return $this->phone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Group
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
        return $this->email;
    }


    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
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
     * Set category
     *
     * @param \AppBundle\Entity\GroupCategory $category
     *
     * @return Groups
     */
    public function setCategory(\AppBundle\Entity\GroupCategory $category = null)
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

            /**
     * Set foto
     *
     * @param string $description
     * @return Groups
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
     * Add Member
     *
     * @param \AppBundle\Entity\Member $member
     * @return Member
     */
    public function addMember(\AppBundle\Entity\Member $member)
    {
        $this->member[] = $member;
    
        return $this;
    }

     /**
     * Remove Member
     *
     * @param \AppBundle\Entity\Member $member
     */
    public function removeMember(\AppBundle\Entity\Member $member)
    {
        $this->member->removeElement($member);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMember()
    {
        return $this->member;
    }

     /**
     * Add Event
     *
     * @param \AppBundle\Entity\Event $event
     * @return event
     */
    public function addEvent(\AppBundle\Entity\Event $event)
    {
        $this->event[] = $event;
    
        return $this;
    }

     /**
     * Remove Event
     *
     * @param \AppBundle\Entity\Event $event
     */
    public function removeEvent(\AppBundle\Entity\Event $event)
    {
        $this->member->removeElement($event);
    }

    /**
     * Get Event
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvent()
    {
        return $this->event;
    }

     /**
     * Add Coupon
     *
     * @param \AppBundle\Entity\Coupon $coupon
     * @return coupon
     */
    public function addCoupon(\AppBundle\Entity\Coupon $coupon)
    {
        $this->coupon[] = $coupon;
    
        return $this;
    }

     /**
     * Remove Coupon
     *
     * @param \AppBundle\Entity\Coupon $coupon
     */
    public function removeCoupon(\AppBundle\Entity\Coupon $coupon)
    {
        $this->member->removeElement($coupon);
    }

    /**
     * Get Coupon
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCoupon()
    {
        return $this->coupon;
    }
}
