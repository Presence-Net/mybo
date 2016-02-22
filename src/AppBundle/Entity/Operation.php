<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Operation
 *
 * @ORM\Table(name="operations")
 * @ORM\Entity
 */
class Operation
{
    const RECUR_ADJUSTBALANCE = 'adjustbalance';
    const RECUR_ONCE = 'once';
    const RECUR_DAILY = 'daily';
    const RECUR_WEEKLY = 'weekly';
    const RECUR_MONTHLY = 'monthly';
    const RECUR_YEARLY = 'yearly';
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="User", inversedBy="operations")
     */
    private $user;

    /**
     * @var Category
     *
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="operations")
     */
    private $category;

    /**
     * @var OperationModification
     *
     * @ORM\OneToMany(targetEntity="OperationModification", mappedBy="operation")
     */
    private $modifications;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     */
    private $amount = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="date")
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="date", nullable=true)
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="recurrence", type="string", length=255)
     */
    private $recurrence;

    /**
     * @var integer
     *
     * @ORM\Column(name="recurrenceInterval", type="integer")
     */
    private $recurrenceInterval = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer")
     */
    private $count = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="days", type="string", length=255, nullable=true)
     */
    private $days;

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
     */
    private $icon;

    
    public function __construct() {
        $this->modifications = new ArrayCollection();
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
     * Set user
     *
     * @param integer $user
     * @return Operation
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return integer 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set category
     *
     * @param integer $category
     * @return Operation
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return integer 
     */
    public function getCategory()
    {
        return $this->category;
    }

    public function addModification($modification)
    {
        if(!$this->modifications->contains($modification))
        {
            $this->modifications[] = $modification;
        }
        
        return $modification;
    }
    public function removeModification($modification)
    {
        if($this->modifications->contains($modification))
        {
            $this->modifications->removeElement($modification);
        }
        
        return $this;
    }
    public function getModifications()
    {
        return $this->modifications;
    }
    
    public function hasModifications()
    {
        return count($this->getModifications()) > 0;
    }


    /**
     * Set name
     *
     * @param string $name
     * @return Operation
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
     * @return Operation
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
     * Set amount
     *
     * @param float $amount
     * @return Operation
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     * @return Operation
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime 
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     * @return Operation
     */
    public function setEndDate($endDate)
    {
        $this->endDate = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime 
     */
    public function getEndDate()
    {
        return $this->endDate;
    }

    /**
     * Set recurrence
     *
     * @param string $recurrence
     * @return Operation
     */
    public function setRecurrence($recurrence)
    {
        $this->recurrence = $recurrence;

        return $this;
    }

    /**
     * Get recurrence
     *
     * @return string 
     */
    public function getRecurrence()
    {
        return $this->recurrence;
    }

    /**
     * Set recurrenceInterval
     *
     * @param integer $recurrenceInterval
     * @return Operation
     */
    public function setRecurrenceInterval($recurrenceInterval)
    {
        $this->recurrenceInterval = $recurrenceInterval;

        return $this;
    }

    /**
     * Get recurrenceInterval
     *
     * @return integer 
     */
    public function getRecurrenceInterval()
    {
        return $this->recurrenceInterval;
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return Operation
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Set days
     *
     * @param string $days
     * @return Operation
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return string 
     */
    public function getDays()
    {
        return $this->days;
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

}
