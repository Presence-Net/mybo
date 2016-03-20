<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Modification;

class ModificationController extends ApiCrudController
{
    public function __construct() {
        $this->class = 'Modification';
        $this->name = 'modification';
        $this->name = 'modifications';
        $this->parentField = 'instance';
        
        parent::__construct();
    }
}
