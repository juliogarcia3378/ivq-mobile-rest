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
     * @var \Advertiser
     *
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\Advertiser",mappedBy="user",cascade={"persist","remove"})
     */
    private $advertiser;

   /**
     * @var \invalidAttempts
     *
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\InvalidAttempts",mappedBy="user",cascade={"persist","remove"})
     */
    private $invalidAttempts;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Member",mappedBy="user",cascade={"persist","remove"})
     */
    private $member;

     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Follow",mappedBy="following",cascade={"persist","remove"})
     */
    private $following;

       /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Follow",mappedBy="follower",cascade={"persist","remove"})
     */
    private $follower;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FavouriteGroup",mappedBy="favourite_group",cascade={"persist","remove"})
     */
    private $favourite_group;

        /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\FavouriteGroup",mappedBy="favourite_member",cascade={"persist","remove"})
     */
    private $favourite_member;

     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\BusinessCard",mappedBy="user",cascade={"persist","remove"})
     */
    private $businesscard;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Media",mappedBy="user",cascade={"persist","remove"})
     */
    private $media;


      /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", nullable=true)
     */
    protected  $token;

      /**
     * @var string
     *
     * @ORM\Column(name="linkedinID", type="string", nullable=true)
     */
    protected  $linkedinID;
    
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
        $this->following = new \Doctrine\Common\Collections\ArrayCollection();
        $this->follower = new \Doctrine\Common\Collections\ArrayCollection();
        $this->businesscard = new \Doctrine\Common\Collections\ArrayCollection();
        $this->media = new \Doctrine\Common\Collections\ArrayCollection();


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
    public function setLinkedinID($linkedinID)
    {
        return $this->linkedinID=$linkedinID;
    }
    

    /**
     * Get profesor
     *
     */
    public function getLinkedinID()
    {
        return $this->linkedinID;
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

      public function setAdvertiser(\AppBundle\Entity\Advertiser $advertiser)
    {
        return $this->advertiser=$advertiser;
    }
    

    /**
     * Get profesor
     *
     * @return \AppBundle\Entity\Advertiser 
     */
    public function getAdvertiser()
    {
        return $this->advertiser;
    }

         /**
     * @return null
     */
    public function setInvalidAttempts(\AppBundle\Entity\InvalidAttempts $invalidAttempts)
    {
        return $this->invalidAttempts=$invalidAttempts;
    }
             /**
     * @return null
     */
    public function removeInvalidAttempts()
    {
         unset($this->invalidAttempts);
    }

    /**
     * Get profesor
     *
     * @return \AppBundle\Entity\InvalidAttempts $invalidAttempts
     */
    public function getInvalidAttempts()
    {
        return $this->invalidAttempts;
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

     /**
     * Add Following
     *
     * @param \AppBundle\Entity\Follow $Following
     * @return Follow
     */
    public function addFollowing(\AppBundle\Entity\Follow $follow)
    {
        $this->following[] = $following;
    
        return $this;
    }

     /**
     * Remove following
     *
     * @param \AppBundle\Entity\Follow $following
     */
    public function removeFollowing(\AppBundle\Entity\Follow $following)
    {
        $this->following->removeElement($following);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFollowing()
    {
        return $this->following;
    }
    /**
     * Add Follow
     *
     * @param \AppBundle\Entity\Follow $follower
     * @return Follow
     */
    public function addFollower(\AppBundle\Entity\Follow $follower)
    {
        $this->follower[] = $follower;
    
        return $this;
    }

     /**
     * Remove Follower
     *
     * @param \AppBundle\Entity\Follower $follower
     */
    public function removeFollower(\AppBundle\Entity\Follow $follower)
    {
        $this->follower->removeElement($follower);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFollower()
    {
        return $this->follower;
    }

        /**
     * Add BusinessCard
     *
     * @param \AppBundle\Entity\BusinessCard $businesscard
     * @return Follow
     */
    public function addBusinessCard(\AppBundle\Entity\BusinessCard $businesscard)
    {
        $this->businesscard[] = $businesscard;
    
        return $this;
    }

     /**
     * Remove BusinessCard
     *
     * @param \AppBundle\Entity\BusinessCard $businesscard
     */
    public function removeBusinessCard(\AppBundle\Entity\BusinessCard $businesscard)
    {
        $this->businesscard->removeElement($businesscard);
    }

    /**
     * Get BusinessCard
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBusinessCard()
    {
        return $this->businesscard;
    }

        /**
     * Add FavouriteGroup
     *
     * @param \AppBundle\Entity\FavouriteGroup $fg
     * @return FavouriteGroup
     */
    public function addFavouriteGroup(\AppBundle\Entity\FavouriteGroup $favourite_group)
    {
        $this->favourite_group[] = $favourite_group;
    
        return $this;
    }

     /**
     * Remove FavouriteGroup
     *
     * @param \AppBundle\Entity\FavouriteGroup $fg
     */
    public function removeFavouriteGroup(\AppBundle\Entity\FavouriteGroup $favourite_group)
    {
        $this->favourite_group->removeElement($favourite_group);
    }

    /**
     * Get FavouriteGroup
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFavouriteGroup()
    {
        return $this->favourite_group;
    }

     /**
     * Add FavouriteGroup
     *
     * @param \AppBundle\Entity\FavouriteMember $fg
     * @return FavouriteMember
     */
    public function addFavouriteMember(\AppBundle\Entity\FavouriteMember $favourite_member)
    {
        $this->favourite_member[] = $favourite_member;
    
        return $this;
    }

     /**
     * Remove FavouriteGroup
     *
     * @param \AppBundle\Entity\FavouriteGroup $fg
     */
    public function removeFavouriteMember(\AppBundle\Entity\FavouriteMember $favourite_member)
    {
        $this->favourite_member->removeElement($favourite_member);
    }

    /**
     * Get FavouriteGroup
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getFavouriteMember()
    {
        return $this->favourite_member;
    }

     /**
     * Add Media
     *
     * @param \AppBundle\Entity\Media $media
     * @return Media
     */
    public function addMedia(\AppBundle\Entity\Media $media)
    {
        $media->setUser($this);
        $this->media[] = $media;
    
        return $this;
    }

     /**
     * Remove Media
     *
     * @param \AppBundle\Entity\Media $media
     */
    public function removeMedia(\AppBundle\Entity\Media $media)
    {
        $this->media->removeElement($media);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getMedia()
    {
        return $this->media;
    }

}
