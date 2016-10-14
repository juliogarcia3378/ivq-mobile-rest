<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="country")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CountryRepository")
 */
class Country
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="country_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="code", type="string", length=50, nullable=false)
     * @Assert\NotBlank(message="Required field")
     */
    private $code;
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;


    /**
    * @var \Group
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\State", mappedBy="country", cascade={"persist","remove"})
     */
    private $state;

  
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
     * Set country_code
     *
     * @param string $code
     * @return Menu
     */
    public function setCode($country_code)
    {
        $this->code = $country_code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set code
     *
     * @param string $country_code
     * @return Menu
     */
    public function setName($name)
    {
        $this->name= $name;

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
     * Constructor
     */
    public function __construct()
    {
        $this->state = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add group
     *
     * @param \AppBundle\Entity\State $state
     *
     * @return GroupCategory
     */
    public function addGroup(\AppBundle\Entity\State $state)
    {
        $this->state[] = $state;
    
        return $this;
    }

    /**
     * Remove group
     *
     * @param \AppBundle\Entity\State $state
     */
    public function removeGroup(\AppBundle\Entity\State $state)
    {
        $this->groups->removeElement($state);
    }

    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getState()
    {
        return $this->state;
    }

    public function __toString()
    {
        return $this->name;
    }

}
