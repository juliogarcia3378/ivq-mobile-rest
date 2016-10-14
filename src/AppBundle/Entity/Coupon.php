<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Table(name="coupon")
 * @ORM\Entity(repositoryClass="App\Repository\CouponRepository")
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
     * @ORM\Column(name="information", type="text",  nullable=false)
     * @Assert\Email
     * @Assert\NotBlank(message="Email required field")
     */
    private $information;



            /**
     * @var string
     * @ORM\Column(name="expires_at", type="datetime",  nullable=false)
     * @Assert\Email
     * @Assert\NotBlank(message="Date required field")
     */
    private $expires_at;


        /**
     * @var string
     * @ORM\Column(name="qr", type="string", length=250, nullable=false)
     * @Assert\Email
     * @Assert\NotBlank(message="QR field required")
     */
    private $qr;

        /**
     * @var string
     * @ORM\Column(name="logo", type="string", length=250, nullable=false)
     * @Assert\Email
     * @Assert\NotBlank(message="Logo field required")
     */
    private $logo;


    /**
     * @var \AppBundle\Entity\Groups
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MyGroups",inversedBy="event")
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
     * @param string $qr
     *
     * @return Coupon
     */
    public function setQR($qr)
    {
        $this->qr = $qr;
    
        return $this;
    }

    /**
     * Get qr
     *
     * @return string
     */
    public function getQR()
    {
        return $this->qr;
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




    public function setGroups(\AppBundle\Entity\MyGroups $groups = null)
    {
        $this->group = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return \AppBundle\Entity\MyGroups
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
     * Set foto
     *
     * @param string $updated_at
     * @return Event
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    /**
     * Get foto
     *
     * @return string 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}
