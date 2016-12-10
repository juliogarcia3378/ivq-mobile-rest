<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="survey")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SurveyRepository")
 */
class Survey
{


   /**
     * @var integer
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="survey_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;


    /**
     * @var string
     * @ORM\Column(name="name", type="string",length=50, nullable=true)
     */
    private $name;

     /**
     * @var \AppBundle\Entity\Survey
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User",inversedBy="survey")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
    private $user;

    /**
     * @var \AppBundle\Entity\SurveyRow
     *
     * @ORM\OneToOne(targetEntity="SurveyRow",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="yes", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     * })
     */
      private $yes;

     /**
     * @var \AppBundle\Entity\SurveyRow
     * @ORM\OneToOne(targetEntity="SurveyRow",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="no", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     * })
     */
      private $no;

     /**
     * @var \AppBundle\Entity\ESurvey
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\ESurvey",inversedBy="type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type", referencedColumnName="id",onDelete="CASCADE")
     * })
     */
       private $type;

     /**
     * @var \AppBundle\Entity\Broadcast
     * @ORM\OneToOne(targetEntity="Broadcast",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="broadcast", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     * })
     */
      private $broadcast;

          /**
     * @var string
     * @ORM\Column(name="question", type="text", nullable=true)
     */
    private $question;
  
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
     * Set code
     *
     * @param string $name
     * @return Profile
     */
    public function setType($type)
    {
        $this->type= $type;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
    

    /**
     * Set code
     *
     * @param string $name
     * @return Profile
     */
    public function setBroadcast($type)
    {
        $this->broadcast= $type;
        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getBroadcast()
    {
        return $this->broadcast;
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
    public function setYes($yes)
    {
        $this->yes = $yes;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getYes()
    {
        return $this->yes;
    }
        /**
     * Set address
     *
     * @param string $address
     *
     * @return Group
     */
    public function setNo($no)
    {
        $this->no = $no;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getNo()
    {
        return $this->no;
    }


    public function getQuestion()
    {
        return $this->question;
    }
     
    public function setQuestion($question)
    {
        $this->question = $question;

        return $this;
    }

    public function __construct()
    {
    }

    public function __toString(){
        return $this->getName();
    }


}
