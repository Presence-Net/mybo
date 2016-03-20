<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Instance;

class InstanceController extends ApiCrudController
{
    public function __construct() {
        $this->class = 'Instance';
        $this->name = 'instance';
        $this->plural = 'instances';
        $this->parentField = 'operation';
        
        parent::__construct();
    }
    
    public function getModificationsAction($instanceId)
    {
        $entity = $this->getEntity($instanceId);
        
        return $this->createView($entity->getModifications(), array('modifications'));
    }
}
