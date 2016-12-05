<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * 
 *
 * @ORM\Table(name="favourite_member")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FavouriteMemberRepository")
 */
class FavouriteMember
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="favourite_member_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;



     /**
     * @var AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="favourite_member")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     * })
     */
       private $user;
         /**
     * @var \AppBundle\Entity\Member
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Member",inversedBy="member")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="member", referencedColumnName="id",nullable=false, onDelete="CASCADE")
     * })
     */
       private $member;


  
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
     * @param \AppBundle\Entity\Member $member
     *
     * @return Groups
     */
    public function setMember(\AppBundle\Entity\Member $member = null)
    {
        $this->member = $member;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
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
