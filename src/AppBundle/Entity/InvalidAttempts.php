<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="invalid_attempts")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfileRepository")
 */
class InvalidAttempts
{
    /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="profile_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


    /**
     * @var string
     * @ORM\Column(name="registration", type="integer", nullable=true)
     */
    private $registration;

    /**
     * @var string
     * @ORM\Column(name="login", type="integer", nullable=true)
     */
    private $login;
    
    /**
     * @var \Users
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id",nullable=true)
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
     * Set code
     *
     * @param integer $registration
     * @return InvalidAttempts
     */
    public function setRegistration($registration)
    {
        $this->registration= $registration;
        return $this;
    }

    /**
     * Get registration
     *
     * @return integer
     */
    public function getRegistration()
    {
        return $this->registration;
    }

        /**
     * Get login
     *
     * @return integer
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * Set login
     *
     * @param integer $login
     * @return InvalidAttempts
     */
    public function setLogin($login)
    {
        $this->login= $login;

        return $this;
    }

    /**
     * Get phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set phone
     *
     * @param string $phone
     * @return Profile
     */
    public function setPhone($phone)
    {
        $this->phone= $phone;

        return $this;
    }


    /**
     * Get avatar
     *
     * @return string
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * Set avatar
     *
     * @param string $avatar
     * @return Profile
     */
    public function setAvatar($avatar)
    {
        $this->avatar= $avatar;

        return $this;
    }


    /**
     * Set User
     *
     * @param string $user
     * @return Profile
     */
    public function setUser(\AppBundle\Entity\User $user)
    {
        $this->user= $user;

        return $this;
    }

    /**
     * Get namee
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Group
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }


    public function __construct()
    {
    }

    public function __toString(){
        return $this->getName()." ".$this->getLastname();
    }

       public function getFullName(){
        return $this->getName()." ".$this->getLastname();
    }

}
