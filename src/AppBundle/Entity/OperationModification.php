<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * OperationModification
 *
 * @ORM\Table(name="operation_modifications")
 * @ORM\Entity
 */
class OperationModification
{
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
     * @var Operation
     *
     * @ORM\ManyToOne(targetEntity="Operation", inversedBy="modifications")
     * @ORM\JoinColumn(name="operation_id", referencedColumnName="id")
     */
    private $operation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="oldDate", type="date", nullable=true)
     */
    private $oldDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="newDate", type="date", nullable=true)
     */
    private $newDate;

    /**
     * @var float
     *
     * @ORM\Column(name="oldAmount", type="float", nullable=true)
     */
    private $oldAmount;

    /**
     * @var float
     *
     * @ORM\Column(name="newAmount", type="float", nullable=true)
     */
    private $newAmount;


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
     * @param User $user
     * @return OperationModification
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set operation
     *
     * @param Operation $operation
     * @return OperationModification
     */
    public function setOperation($operation)
    {
        $this->operation = $operation;

        return $this;
    }

    /**
     * Get operation
     *
     * @return Operation 
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * Set oldDate
     *
     * @param \DateTime $oldDate
     * @return OperationModification
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
     * @return OperationModification
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
     * @return OperationModification
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
     * @return OperationModification
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
}
