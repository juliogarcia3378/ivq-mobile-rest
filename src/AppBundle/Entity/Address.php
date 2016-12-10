<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="address")
  * @ORM\Entity(repositoryClass="AppBundle\Repository\AddressRepository")
 */
class Address
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="address_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


    /**
     * @var string
     * @ORM\Column(name="name", type="text", nullable=true)
     */
    private $address;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", length=50, nullable=false)
     */
    private $city;

   /**
     * @var \AppBundle\Entity\State
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\State",inversedBy="address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="state", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
       private $state;


    /**
     * @var integer
     * @ORM\Column(name="zip", type="integer",  nullable=true)
     * @Assert\NotBlank(message="Required field")
     */
    private $zip;



  
    /**
     * @var \Groups
     *
     * @ORM\OneToOne(targetEntity="Groups",mappedBy="address")
     */
    private $groups;

    /**
     * @var \Groups
     *
     * @ORM\OneToOne(targetEntity="Profile",mappedBy="address")
     */
    private $profile;

  
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
     * Get group
     *
     * @return AppBundle\Entity\Groups
     */
    public function getGroup()
    {
        return $this->groups;
    }
     /**
     * Get group
     *
     * @return AppBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }

    /**
     * Set code
     *
     * @param string $address
     * @return Menu
     */
    public function setAddress($address)
    {
        $this->address= $address;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getAddress()
    {   if ($this->address==null)
        return "";
        return $this->address;
    }

        /**
     * Set code
     *
     * @param string $City
     * @return String
     */
    public function setCity($city)
    {
        $this->city= $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        if ($this->city==null)
        return "";
        return $this->city;
    }

     /**
     * Set zip
     *
     * @param string $zip
     *
     * @return Group
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

    public function __construct()
    {
    }
        /**
     * Set State
     *
     * @param AppBundle\Entity\State $state
     *
     * @return Groups
     */
    public function setState(\AppBundle\Entity\State $state = null)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\State
     */
    public function getState()
    {
        return $this->state;
    }

    public function __toString(){
        return $this->getAddress();
    }

        public function getCityAndState(){
        return $this->getCity().", ".$this->getState()->getCode();
    }

        public function getDescription(){
            if ($this->getCity()!='')

        return $this->getAddress().", ".$this->getCity().", ".$this->getState()->getCode().' '.$this->getZip();

          return $this->getAddress().", ".$this->getState()->getCode().' ,'.$this->getZip();
    }


}
