<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="follow")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FollowRepository")
 */
class Follow
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
     * @var \AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="following")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="following", referencedColumnName="id")
     * })
     */
       private $following;

  
      /**
     * @var \AppBundle\Entity\User
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="follower")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="follower", referencedColumnName="id")
     * })
     */
       private $follower;

  
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
    public function getFollowing()
    {
        return $this->following;
    }
 
         /**
     * Set User
     *
     * @param \AppBundle\Entity\User $following
     *
     * @return User
     */
    public function setFollowing(\AppBundle\Entity\User $following = null)
    {
        $this->following = $following;

        return $this;
    }
            /**
     * Get User
     *
     * @return \AppBundle\Entity\User
     */
    public function getFollower()
    {
        return $this->follower;
    }
 
         /**
     * Set User
     *
     * @param \AppBundle\Entity\User $follower
     *
     * @return User
     */
    public function setFollower(\AppBundle\Entity\User $follower = null)
    {
        $this->follower = $follower;

        return $this;
    }

    


    public function __toString(){
        return $this->getUser()->getId();
    }

      


}
