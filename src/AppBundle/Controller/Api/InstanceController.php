<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\Instance;

class InstanceController extends ApiController
{
    public function __construct() {
        $this->class = 'Instance';
        $this->parentField = 'operation';
    }
    
    public function cgetAction($categoryId, $operationId)
    {
        $entities = $this->getEntities($operationId);
        
        return $this->createView($entities);
    }
    
    public function getAction($categoryId, $operationId, $instanceId)
    {
        $entity = $this->getEntity($instanceId);
        
        return $this->createView($entity);
    }
}
