<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="survey_row")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SurveyRepository")
 */
class SurveyRow
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="survey_row_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

         /**
     * @var \AppBundle\Entity\Media
     * @ORM\OneToOne(targetEntity="Media",cascade={"persist", "remove"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="media", referencedColumnName="id",nullable=false,onDelete="CASCADE")
     * })
     */
      private $media;


  
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

    /**
     * Set code
     *
     * @param string $state_code
     * @return Menu
     */
    public function setDescription($description)
    {
        $this->description= $description;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set code
     *
     * @param string $state_code
     * @return Menu
     */
    public function setMedia(\AppBundle\Entity\Media $media)
    {
        $this->media= $media;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getMedia()
    {
        return $this->media;
    }

  



}

