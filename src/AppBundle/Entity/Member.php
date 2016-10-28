<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="member")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MemberRepository")
 */
class Member
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="member_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


   /**
     * @var \AppBundle\Entity\Groups
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Groups",inversedBy="member")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="groups", referencedColumnName="id")
     * })
     */
       private $groups;

  
 /**
     * @var \AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="member")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id")
     * })
     */
       private $user;

  
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
     * @return \AppBundle\Entity\Groups
     */
    public function getGroups()
    {
        return $this->groups;
    }
 
         /**
     * Set State
     *
     * @param \AppBundle\Entity\Groups $group
     *
     * @return Groups
     */
    public function setGroups(\AppBundle\Entity\Groups $group = null)
    {
        $this->groups = $group;

        return $this;
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
     * @param \AppBundle\Entity\User $user
     *
     * @return Groups
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    


    public function __toString(){
        return $this->getUser()->getId();
    }

      


}
