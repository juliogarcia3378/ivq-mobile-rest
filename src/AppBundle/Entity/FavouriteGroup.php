<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 
 *
 * @ORM\Table(name="favourite_group")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FavouriteGroupRepository")
 */
class FavouriteGroup
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="favourite_group_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



     /**
     * @var AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="favourite_group")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id",nullable=false)
     * })
     */
       private $user;
       

         /**
     * @var \AppBundle\Entity\Member
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Groups",inversedBy="groups")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="groups", referencedColumnName="id",nullable=false)
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
     * Set category
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

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Groups
     */
    public function getGroups()
    {
        return $this->groups;
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
     * @return \AppBundle\Entity\User $user
     */
    public function getUser()
    {
        return $this->user;
    }
    
  


}
