<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation\Groups;
use Gedmo\Mapping\Annotation as Gedmo;

use AppBundle\Entity\Instance;
use AppBundle\Entity\Modification;

/**
 * CalendarInstance
 */
class CalendarInstance extends Instance
{
    /**
     * @var Instance
     *
     * @Groups({"calendar"})
     */
    public $instance;
    /**
     * @var Modification
     *
     * @Groups({"calendar"})
     */
    public $modification;
    
    public function __construct(\AppBundle\Entity\Instance $instance = null) {
        $this->instance = $instance;

        parent::__construct();
    }

    public function __get($attrib_name) {
        if ($this->instance->$attrib_name) {
            return $this->instance->$attrib_name;
        } else {
            return $this->$attrib_name;
        }
    }

    /**
     * Set modification
     *
     * @param integer $modification
     * @return Instance
     */
    public function setModification($modification)
    {
        $this->modification = $modification;

        return $this;
    }

    /**
     * Get modification
     *
     * @return integer 
     */
    public function getModification()
    {
        return $this->modification;
    }
}