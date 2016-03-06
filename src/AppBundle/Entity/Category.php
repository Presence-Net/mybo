<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\Groups;

use Gedmo\Mapping\Annotation as Gedmo;
use Gedmo\Translatable\Translatable;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 */
class Category implements Translatable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Groups({"category", "operation", "categories", "category_operations"})
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Gedmo\Translatable
     * 
     * @Groups({"category", "operation", "categories", "category_operations"})
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Gedmo\Translatable
     * 
     * @Groups({"category", "operation", "categories", "category_operations"})
     */
    private $description = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer")
     * 
     * @Groups({"category", "operation", "categories", "category_operations"})
     */
    private $rank = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDefault", type="boolean", nullable=true)
     * 
     * @Groups({"category", "operation", "categories", "category_operations"})
     */
    private $isDefault = false;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="isHidden", type="boolean", nullable=true)
     * 
     * @Groups({"category", "operation", "categories", "category_operations"})
     */
    private $isHidden = false;
    
    /**
     *
     * @var Category 
     * 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", cascade={"all"}, fetch="LAZY")
     * 
     * @Groups({"category", "operation", "categories", "category_operations"})
     */
    private $parent = null;

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;
    
    /**
     * Sonata Media
     *
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * 
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"}, fetch="LAZY")
     * 
     * @Groups({"category", "operation", "categories", "category_operations"})
     */
    private $icon;
    
    /**
     * @ORM\OneToMany(targetEntity="Operation", mappedBy="category")
     * @ORM\OrderBy({"name" = "ASC"})
     * 
     * @Groups({"category"})
     */
    private $operations;

    
    public function __construct() {
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() {
        return $this->getName();
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
     * @return Category
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

    /**
     * Set description
     *
     * @param string $description
     * @return Category
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set rank
     *
     * @param integer $rank
     * @return Category
     */
    public function setRank($rank)
    {
        $this->rank = $rank;

        return $this;
    }

    /**
     * Get rank
     *
     * @return integer 
     */
    public function getRank()
    {
        return $this->rank;
    }

    /**
     * Set isDefault
     *
     * @param boolean $isDefault
     * @return Category
     */
    public function setIsDefault($isDefault)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault
     *
     * @return boolean 
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }
    
    /**
     * Set isHidden
     *
     * @param boolean $isHidden
     * @return Category
     */
    public function setIsHidden($isHidden)
    {
        $this->isHidden = $isHidden;

        return $this;
    }

    /**
     * Get isHidden
     *
     * @return boolean 
     */
    public function getIsHidden()
    {
        return $this->isHidden;
    }
    
    /**
     * Set parent
     *
     * @param Category $parent
     * @return Category
     */
    public function setParent($parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return Category 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set icon
     *
     * @param Media $icon
     * @return Category
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;

        return $this;
    }

    /**
     * Get icon
     *
     * @return Media 
     */
    public function getIcon()
    {
        return $this->icon;
    }

    /**
     * 
     * @param type $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }
    
    /**
     * Get the operations
     * 
     * @return ArrayCollection
     */
    public function getOperations()
    {
        return $this->operations;
    }

}
