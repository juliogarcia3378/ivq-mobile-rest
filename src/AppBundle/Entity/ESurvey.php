<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="ESurvey")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SurveyRepository")
 */
class ESurvey
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="survey_type_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;




     /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Survey",mappedBy="broadcastType",cascade={"persist","remove"})
     */
    private $survey;
  
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
     * @param string $state_code
     * @return Menu
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


    public function __construct()
    {
         $this->survey = new \Doctrine\Common\Collections\ArrayCollection();
    }
     /**
     * Add Member
     *
     * @param \AppBundle\Entity\Survey $survey
     * @return Survey
     */
    public function addSurvey(\AppBundle\Entity\Survey $survey)
    {
        $this->survey[] = $survey;
    
        return $this;
    }

     /**
     * Remove Survey
     *
     * @param \AppBundle\Entity\Survey $survey
     */
    public function removeSurvey(\AppBundle\Entity\Survey $survey)
    {
        $this->survey->removeElement($survey);
    }

    /**
     * Get Member
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSurvey()
    {
        return $this->survey;
    }

    public function __toString(){
        return $this->name;
    }



}

