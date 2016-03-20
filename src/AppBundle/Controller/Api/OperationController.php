<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Operation;

class OperationController extends ApiCrudController
{
    public function __construct() {
        $this->class = 'Operation';
        $this->name = 'operation';
        $this->plural = 'operations';
        $this->parentField = 'category';
        
        parent::__construct();
    }
    
    public function getInstancesAction($id)
    {
        $entity = $this->getEntity($id);
        
        return $this->createView($entity->getInstances(), array('instances'));
    }
}
