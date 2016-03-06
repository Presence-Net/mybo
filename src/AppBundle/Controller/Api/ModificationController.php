<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\Entity\InstanceModification;

class ModificationController extends ApiController
{
    public function __construct() {
        $this->class = 'InstanceModification';
        $this->parentField = 'instance';
    }
    
    public function cgetAction($categoryId, $operationId, $instanceId)
    {
        $entities = $this->getEntities($instanceId);
        
        return $this->createView($entities);
    }
    
    public function getAction($categoryId, $operationId, $instanceId, $modificationId)
    {
        $entity = $this->getEntity($modificationId);
        
        return $this->createView($entity);
    }
}
