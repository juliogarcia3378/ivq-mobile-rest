<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="profile")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ProfileRepository")
 */
class Profile
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
     * @ORM\Column(name="name", type="string",length=50, nullable=false)
     */
    private $name;

    /**
     * @var string
     * @ORM\Column(name="lastname", type="string", length=50, nullable=false)
     */
    private $lastname;


    /**
     * @var integer
     * @ORM\Column(name="phone", type="string", length=12, nullable=false)
     * @Assert\NotBlank(message="Phone field Required ")
     */
    private $phone;

    /**
     * @var string
     * @ORM\Column(name="avatar", type="text", nullable=true)
     */
    private $avatar;



    /**
     * @var \Users
     *
     * @ORM\OneToOne(targetEntity="\AppBundle\Entity\User",mappedBy="profile")
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
     * @param string $name
     * @return Profile
     */
    public function setName($name)
    {
        $this->name= $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

        /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Profile
     */
    public function setLastname($name)
    {
        $this->lastname= $name;

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