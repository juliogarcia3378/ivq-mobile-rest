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
     * @var \AppBundle\Entity\MyGroups
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\MyGroups",inversedBy="member")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="group", referencedColumnName="id")
     * })
     */
       private $group;

  
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
     * @return \AppBundle\Entity\MyGroups
     */
    public function getGroup()
    {
        return $this->group;
    }
 
         /**
     * Set State
     *
     * @param \AppBundle\Entity\MyGroups $group
     *
     * @return Groups
     */
    public function setGroup(\AppBundle\Entity\MyGroups $group = null)
    {
        $this->group = $group;

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
     * @param \AppBundle\Entity\Users $use
     *
     * @return Groups
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    

    public function __construct()
    {
    }




    public function __toString(){
        return $this->getUser()->getId();
    }

      


}
