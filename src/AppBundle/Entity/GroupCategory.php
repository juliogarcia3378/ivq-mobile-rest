<?php


namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Rol
 * @ORM\Table(name="groupCategory")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GroupCategoryRepository")
 */
class GroupCategory
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\SequenceGenerator(sequenceName="group_category_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="text", nullable=false)
     */
    private $name;

    /**
    * @var \Group
     *
     * @ORM\OneToMany(targetEntity="\AppBundle\Entity\MyGroups", mappedBy="category", cascade={"persist","remove"})
     */
    private $groups;

  

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->groups = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return GroupCategory
     */
    public function setName($name)
    {
        $this->name = $name;
    
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

 
    public function addGroup(\AppBundle\Entity\MyGroups $group)
    {
        $this->groups[] = $group;
    
        return $this;
    }

    
    public function removeGroup(\AppBundle\Entity\MyGroups $group)
    {
        $this->groups->removeElement($group);
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

    public function __toString()
    {
        return $this->name;
    }
}
