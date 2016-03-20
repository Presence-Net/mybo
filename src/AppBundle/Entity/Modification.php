<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

use JMS\Serializer\Annotation\Groups;

/**
 * Modification
 *
 * @ORM\Table(name="instance_modifications")
 * @ORM\Entity
 */
class Modification
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @Groups({"modification", "modifications", "instance"})
     */
    private $id;

    /**
     * @var Instance
     *
     * @ORM\ManyToOne(targetEntity="Instance", inversedBy="modifications")
     * @ORM\JoinColumn(name="instance_id", referencedColumnName="id")
     * 
     * @Groups({"modification"})
     */
    private $instance;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="oldDate", type="date", nullable=true)
     * 
     * @Groups({"modification", "modifications", "instance"})
     */
    private $oldDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="newDate", type="date", nullable=true)
     * 
     * @Groups({"modification", "modifications", "instance"})
     */
    private $newDate;

    /**
     * @var float
     *
     * @ORM\Column(name="oldAmount", type="float", nullable=true)
     * 
     * @Groups({"modification", "modifications", "instance"})
     */
    private $oldAmount;

    /**
     * @var float
     *
     * @ORM\Column(name="newAmount", type="float", nullable=true)
     * 
     * @Groups({"modification", "modifications", "instance"})
     */
    private $newAmount;

    /**
     * @var boolean
     *
     * @ORM\Column(name="noop", type="boolean")
     * 
     * @Groups({"modification", "modifications", "instance"})
     */
    private $noop;


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
     * Set instance
     *
     * @param Instance $instance
     * @return Modification
     */
    public function setInstance($instance)
    {
        $this->instance = $instance;

        return $this;
    }

    /**
     * Get instance
     *
     * @return Instance 
     */
    public function getInstance()
    {
        return $this->instance;
    }

    /**
     * Set oldDate
     *
     * @param \DateTime $oldDate
     * @return Modification
     */
    public function setOldDate($oldDate)
    {
        $this->oldDate = $oldDate;

        return $this;
    }

    /**
     * Get oldDate
     *
     * @return \DateTime 
     */
    public function getOldDate()
    {
        return $this->oldDate;
    }

    /**
     * Set newDate
     *
     * @param \DateTime $newDate
     * @return Modification
     */
    public function setNewDate($newDate)
    {
        $this->newDate = $newDate;

        return $this;
    }

    /**
     * Get newDate
     *
     * @return \DateTime 
     */
    public function getNewDate()
    {
        return $this->newDate;
    }

    /**
     * Set oldAmount
     *
     * @param float $oldAmount
     * @return Modification
     */
    public function setOldAmount($oldAmount)
    {
        $this->oldAmount = $oldAmount;

        return $this;
    }

    /**
     * Get oldAmount
     *
     * @return float 
     */
    public function getOldAmount()
    {
        return $this->oldAmount;
    }

    /**
     * Set newAmount
     *
     * @param float $newAmount
     * @return Modification
     */
    public function setNewAmount($newAmount)
    {
        $this->newAmount = $newAmount;

        return $this;
    }

    /**
     * Get newAmount
     *
     * @return float 
     */
    public function getNewAmount()
    {
        return $this->newAmount;
    }

    /**
     * Set noop
     *
     * @param Noop $noop
     * @return Modification
     */
    public function setNoop($noop)
    {
        $this->noop = $noop;

        return $this;
    }

    /**
     * Get noop
     *
     * @return Noop 
     */
    public function getNoop()
    {
        return $this->noop;
    }
}
