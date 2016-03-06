<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

use Gedmo\Mapping\Annotation as Gedmo;

use Gedmo\Translatable\Translatable;

/**
 * Category
 *
 * @ORM\Table(name="categories")
 * @ORM\Entity
 * 
 * @ExclusionPolicy("all")
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
     * @Expose
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     * @Gedmo\Translatable
     * 
     * @Expose
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     * @Gedmo\Translatable
     * 
     * @Expose
     */
    private $description = null;

    /**
     * @var integer
     *
     * @ORM\Column(name="rank", type="integer")
     * 
     * @Expose
     */
    private $rank = 0;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDefault", type="boolean", nullable=true)
     * 
     * @Expose
     */
    private $isDefault = false;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="isHidden", type="boolean", nullable=true)
     * 
     * @Expose
     */
    private $isHidden = false;
    
    /**
     *
     * @var Category 
     * 
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Category", cascade={"all"}, fetch="LAZY")
     */
    private $parent = null;

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     * 
     * @Expose
     */
    private $locale;
    
    /**
     * Sonata Media
     *
     * @var \Application\Sonata\MediaBundle\Entity\Media
     * 
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"}, fetch="LAZY")
     * 
     * @Expose
     */
    private $icon;
    
    /**
     * @ORM\OneToMany(targetEntity="Operation", mappedBy="category")
     * 
     * @Expose
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
