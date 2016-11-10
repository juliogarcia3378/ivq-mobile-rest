<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * PrivateGroup
 *
 * @ORM\Table(name="privateroup")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PrivateGroupRepository")
 */
class PrivateGroup
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="privategroup_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


      /**
     * @var \AppBundle\Entity\Advertiser
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Advertiser",inversedBy="privateGroup")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="advertiser", referencedColumnName="id")
     * })
     */
       private $advertiser;

  
      /**
     * @var \Address
     *
     * @ORM\OneToOne(targetEntity="Groups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group", referencedColumnName="id",nullable=false)
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
     * Get group
     *
     * @return \AppBundle\Entity\Advertiser
     */
    public function getAdvertiser()
    {
        return $this->user;
    }
 
         /**
     * Set User
     *
     * @param \AppBundle\Entity\Advertiser $advertiser
     *
     * @return Advertiser
     */
    public function setAdvertiser(\AppBundle\Entity\Advertiser $user = null)
    {
        $this->user = $user;

        return $this;
    }
            /**
     * Get Groups
     *
     * @return \AppBundle\Entity\Groups
     */
    public function getGroups()
    {
        return $this->groups;
    }
 
         /**
     * Set User
     *
     * @param \AppBundle\Entity\Groups $groups
     *
     * @return Groups
     */
    public function setGroups(\AppBundle\Entity\Groups $groups = null)
    {
        $this->groups = $groups;

        return $this;
    }

    
    public function __toString(){
        return $this->getGroups()->getName();
    }

      


}
