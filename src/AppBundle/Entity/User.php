<?php

namespace AppBundle\Entity;

use Core\MySecurityBundle\Enums\EGroup;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Entity\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints as DocAssert;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Users
 *
 * @ORM\Table(name="users")
 * @ORM\HasLifecycleCallbacks()
 * @DocAssert\UniqueEntity(fields={"emailCanonical"}, errorPath="email",message="Already exist an user with with email.")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UsuarioRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="usuario_id_seq", allocationSize=1, initialValue=1)
     */
    protected  $id;


          /**
     * @var \Profile
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Profile",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profile", referencedColumnName="id",nullable=true)
     * })
     */
    private $profile;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Member",mappedBy="user",cascade={"persist","remove"})
     */
    private $member;


      /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", nullable=true)
     */
    protected  $token;

 
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function getGroupsId(){
      
        $ids = array();
       // foreach ($grupos as $group) {
       //     $ids[] = $group->getId();
      //  }

        return $ids;
    }
    public function isAdmin()
    {
        $user = $this;
        if(in_array("ROLE_ADMIN",$user->getRoles()))
            return true;
        return false;
    }
      
        public function isAdvertiser()
    {
        $user = $this;
        if(in_array("ROLE_ADVERTISER",$user->getRoles()))
            return true;
        return false;
    }

        public function isMember()
    {
        $user = $this;
        if(in_array("ROLE_MEMBER",$user->getRoles()))
            return true;
        return false;
    }
    public function onlyProfe()
    {
        $user = $this;
        if(in_array(EGroup::ADMIN,$user->getGroupsId()) &&
            count($user->getGroupNames()) == 1)
            return true;
        return false;
    }
    /**
     * Returns the user roles
     *
     * @return array The roles
     */
    public function getRoles()
    {
        $roles = $this->roles;

        $roles[] = 'IS_AUTHENTICATED_FULLY';

        return array_unique($roles);
    }

    public function addRoleAdmin()
    {
        if (!$this->isAdmin())
        $this->roles[] = 'ROLE_ADMIN';
    }

    public function addRoleAdvertiser()
    {
        if (!$this->isAdvertiser())
        $this->roles[] = 'ROLE_ADVERTISER';
    }

    public function addRoleMember()
    {
        if (!$this->isMember())
        $this->roles[] = 'ROLE_MEMBER';
    }

    /**
     * Set nombre
     *
     * @param string $token
     * @return token
     */
    public function setToken($token)
    {
        $this->token = $token;
    
        return $this;
    }

   

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->enabled=true;
        $this->salt = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        $this->locked = false;
        $this->expired = false;
        $this->roles = array();
        $this->credentialsExpired = false;
         $this->member = new \Doctrine\Common\Collections\ArrayCollection();

    }

    
    /**
     * Get groups
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroups()
    {
        return $this->groups;
    }


     /**
     * @return null
     */
    public function setProfile(\AppBundle\Entity\Profile $profile)
    {
        return $this->profile=$profile;
    }
    

    /**
     * Get profesor
     *
     * @return \AppBundle\Entity\Profile 
     */
    public function getProfile()
    {
        return $this->profile;
    }


    /**
     * Add Member
     *
     * @param \AppBundle\Entity\Member $member
     * @return Member
     */
    public function addMember(\AppBundle\Entity\Member $member)
    {
        $this->member[] = $member;
    
        return $this;
    }

     /**
     * Remove Member
     *
     * @param \AppBundle\Entity\Member $member
     */
    public function removeMember(\AppBundle\Entity\Member $member)
    {
        $this->member->removeElement($member);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMembers()
    {
        return $this->member;
    }


}
