<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Table(name="business_card_media")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BusinessCardMediaRepository")
 */
class BusinessCardMedia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="business_card_media_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

  
 /**
     * @var \AppBundle\Entity\BusinessCard
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\BusinessCard",inversedBy="businessCardMedia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="businessCard", referencedColumnName="id", onDelete="CASCADE")
     * })
     */
       private $businessCard;



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
     * Get group
     *
     * @return \AppBundle\Entity\BusinessCard
     */
    public function getBusinessCard()
    {
        return $this->businessCard;
    }
 
         /**
     * Set User
     *
     * @param \AppBundle\Entity\BusinessCard $bc
     *
     * @return Groups
     */
    public function setBusinessCard(\AppBundle\Entity\BusinessCard $bc = null)
    {
       // $bc->setBusinessCardMedia($this);
        $this->businessCard = $bc;

        return $this;
    }

    


    public function __toString(){
        return $this->getUser()->getId();
    }

     /**
     * Add Media
     *
     * @param \AppBundle\Entity\Media $media
     * @return Media
     */
    public function setMedia(\AppBundle\Entity\Media $media)
    {
        $this->media = $media;
        return $this;
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
