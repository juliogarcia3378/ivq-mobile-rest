<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 *
 * @ORM\Table(name="EMedia")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MediaRepository")
 */
class EMedia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="emedia_type_id_seq", allocationSize=1, initialValue=1)
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
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Survey",mappedBy="mediaType",cascade={"persist","remove"})
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


    public function __construct()
    {
         $this->media = new \Doctrine\Common\Collections\ArrayCollection();
    }
     /**
     * Add Member
     *
     * @param \AppBundle\Entity\Media $media
     * @return Survey
     */
    public function addMedia(\AppBundle\Entity\Media $media)
    {
        $this->media[] = $media;
    
        return $this;
    }

     /**
     * Remove Survey
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

    public function __toString(){
        return $this->name;
    }



}

