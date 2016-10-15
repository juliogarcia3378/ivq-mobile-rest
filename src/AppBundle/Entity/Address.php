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
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $address;

        /**
     * @var string
     * @ORM\Column(name="city", type="text", nullable=false)
     */
    private $city;

   /**
     * @var \AppBundle\Entity\State
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\State",inversedBy="address")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="state", referencedColumnName="id")
     * })
     */
       private $state;


    /**
     * @var integer
     * @ORM\Column(name="zip", type="integer",  nullable=false)
     * @Assert\NotBlank(message="Required field")
     */
    private $zip;



  
    /**
     * @var \MyGroups
     *
     * @ORM\OneToOne(targetEntity="MyGroups",mappedBy="address")
     */
    private $groups;

  
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
     * Set MyGroups
     *
     * @param AppBundle\Entity\MyGroups $group
     * @return group
     */
    

    /**
     * Get group
     *
     * @return AppBundle\Entity\MyGroups
     */
    public function getGroup()
    {
        return $this->groups;
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
    {
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

        public function getDescription(){
            if ($this->getCity()!='')

        return $this->getAddress().", ".$this->getCity().", zip:".$this->getZip().' ,'.$this->getState()->getCode();

          return $this->getAddress().", zip:".$this->getZip().' ,'.$this->getState()->getCode();
    }


}