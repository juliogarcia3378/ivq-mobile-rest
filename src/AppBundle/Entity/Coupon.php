<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="coupon")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CouponRepository")
 */
class Coupon
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="coupon_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;
    
    /**
     * @var string
     * @ORM\Column(name="code", type="text",  nullable=false)
     */
    private $code;

    /**
     * @var string
     * @ORM\Column(name="name", type="text",  nullable=false)
     * @Assert\NotBlank(message="Name required ")
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="information", type="text",  nullable=true)
     */
    private $information;



    /**
     * @var \DateTime
     * @ORM\Column(name="expires_at", type="date",  nullable=true)
     * @Assert\NotBlank(message="Date required field")
     */
    private $expires_at;

    /**
     * @var string
     * @ORM\Column(name="barcode", type="text",  nullable=true)
     */
    private $barcode;

        /**
     * @var string
     * @ORM\Column(name="logo", type="text", nullable=true)
     */
    private $logo;


    /**
     * @var \AppBundle\Entity\Groups
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Groups",inversedBy="event")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="groups", referencedColumnName="id")
     * })
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
     * Set qr
     *
     * @param text $name
     *
     * @return Coupon
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

      /**
     * Set qr
     *
     * @param text $code
     *
     * @return Coupon
     */
    public function setCode($code)
    {
        $this->code = $code;
    
        return $this;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }


    /**
     * Set qr
     *
     * @param text $barcode
     *
     * @return Coupon
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    
        return $this;
    }

    /**
     * Get barcode
     *
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }


    /**
     * Set information
     *
     * @param string $information
     *
     * @return Group
     */
    public function setInformation($information)
    {
        $this->information = $information;
    
        return $this;
    }

    /**
     * Get information
     *
     * @return string
     */
    public function getInformation()
    {
        return $this->information;
    }




    public function setGroups(\AppBundle\Entity\Groups $groups = null)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return \AppBundle\Entity\Groups
     */
    public function getGroups()
    {
        return $this->groups;
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
     * Set datetime
     *
     * @param string $updated_at
     * @return \DateTime  
     */
    public function setExpiresAt($expires_at)
    {
        $this->expires_at = $expires_at;

        return $this;
    }

    /**
     * Get datetime
     *
     * @return \DateTime  
     */
    public function getExpiresAt()
    {
        return $this->expires_at;
    }
}
