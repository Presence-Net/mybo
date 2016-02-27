<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations\View;

use AppBundle\Entity\InstanceModification;

class ModificationController extends ApiController
{
    public function __construct() {
        $this->class = 'InstanceModification';
        $this->parentField = 'instance';
    }
    
    /**
     * @View()
     */
    public function cgetAction($categoryId, $operationId, $instanceId)
    {
        $entities = $this->getEntities($instanceId);
        
        return $this->createView($entities);
    }
    
    /**
     * @View()
     */
    public function getAction($categoryId, $operationId, $instanceId, $modificationId)
    {
        $entity = $this->getEntity($modificationId);
        
        return $this->createView($entity);
    }
}
