<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="advertiser")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\AdvertiserRepository")
 */
class Advertiser
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="advertiser_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


      /**
     * @var \AppBundle\Entity\User
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User",inversedBy="advertiser")
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="user", referencedColumnName="id",nullable=false)
     * })
     */
       private $user;

  
      /**
     * @var \Address
     *
     * @ORM\OneToOne(targetEntity="GroupCategory")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="category", referencedColumnName="id",nullable=false)
     * })
     */
    private $category;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PrivateGroup",mappedBy="privateGroup",cascade={"persist","remove"})
     */
    private $privateGroup;


       /**
     * Constructor
     */
    public function __construct()
    {
        $this->privateGroup = new \Doctrine\Common\Collections\ArrayCollection();

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
     * @param \AppBundle\Entity\User $following
     *
     * @return User
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }
            /**
     * Get User
     *
     * @return \AppBundle\Entity\GroupCategory
     */
    public function getCategory()
    {
        return $this->category;
    }
 
         /**
     * Set User
     *
     * @param \AppBundle\Entity\GroupCategory $category
     *
     * @return User
     */
    public function setCategory(\AppBundle\Entity\GroupCategory $category = null)
    {
        $this->category = $category;

        return $this;
    }

    


    public function __toString(){
        return $this->getUser()->getId();
    }
     


    /**
     * Add privateGroup
     *
     * @param \AppBundle\Entity\PrivateGroup $privateGroup
     * @return privateGroup
     */
    public function addPrivateGroup(\AppBundle\Entity\PrivateGroup $privateGroup)
    {
        $this->privateGroup[] = $privateGroup;
    
        return $this;
    }

     /**
     * Remove Member
     *
     * @param \AppBundle\Entity\PrivateGroup $privateGroup
     */
    public function removePrivateGroup(\AppBundle\Entity\PrivateGroup $privateGroup)
    {
        $this->privateGroup->removeElement($privateGroup);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPrivateGroup()
    {
        return $this->privateGroup;
    }
      


}
