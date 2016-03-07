<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\Groups;

use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Instance
 *
 * @ORM\Table(name="instances")
 * @ORM\Entity
 */
class Instance
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
     * 
     * @Groups({"instance", "instances", "operation", "modification", "calendar"})
     */
    private $id;

    /**
     * @var Operation
     *
     * @ORM\ManyToOne(targetEntity="Operation", inversedBy="instances")
     * 
     * @Groups({"instance", "calendar"})
     */
    private $operation;

    /**
     * @var InstanceModification
     *
     * @ORM\OneToMany(targetEntity="InstanceModification", mappedBy="instance")
     * 
     * @Groups({"instance"})
     */
    private $modifications;

    /**
     * @var float
     *
     * @ORM\Column(name="amount", type="float")
     * 
     * @Groups({"instance", "instances", "operation", "modification", "calendar"})
     */
    private $amount = 0;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startDate", type="date")
     * 
     * @Groups({"instance", "instances", "operation", "modification"})
     */
    private $startDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="endDate", type="date", nullable=true)
     * 
     * @Groups({"instance", "instances", "operation", "modification"})
     */
    private $endDate;

    /**
     * @var string
     *
     * @ORM\Column(name="recurrence", type="string", length=255)
     * 
     * @Groups({"instance", "instances", "operation", "modification"})
     */
    private $recurrence;

    /**
     * @var integer
     *
     * @ORM\Column(name="recurrenceInterval", type="integer")
     * 
     * @Groups({"instance", "instances", "operation", "modification"})
     */
    private $recurrenceInterval = 0;

    /**
     * @var integer
     *
     * @ORM\Column(name="count", type="integer")
     * 
     * @Groups({"instance", "instances", "operation", "modification"})
     */
    private $count = 0;

    /**
     * @var string
     *
     * @ORM\Column(name="days", type="string", length=255, nullable=true)
     * 
     * @Groups({"instance", "instances", "operation", "modification"})
     */
    private $days;

    /**
     * @Gedmo\Locale
     * Used locale to override Translation listener`s locale
     * this is not a mapped field of entity metadata, just a simple property
     */
    private $locale;

    
    public function __construct() {
        $this->modifications = new ArrayCollection();
    }
    
    /**
     * 
     * @return type
     */
    public function __toString() {
        return $this->getOperation() ? $this->getOperation()->getName() : '';
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
     * Set operation
     *
     * @param integer $operation
     * @return Instance
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Get operation
     *
     * @return integer 
     */
    public function getOperation()
    {
        return $this->operation;
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
     * Set amount
     *
     * @param float $amount
     * @return Instance
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
     * @return Instance
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
     * @return Instance
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
     * @return Instance
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
     * @return Instance
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
     * @return Instance
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
     * @return Instance
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
     * 
     * @param type $locale
     */
    public function setTranslatableLocale($locale)
    {
        $this->locale = $locale;
    }

}
