<?php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Util\Codes;

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
    
    /**
     * Collection get action
     * @var Request $request
     * @return array
     */
    public function cgetAction($categoryId, $operationId)
    {
        $entities = $this->getEntities($operationId);
        
        return $this->createView($entities, array($this->plural));
    }

    /**
     * Get action
     * @var integer $id Id of the entity
     * @return array
     */
    public function getAction($categoryId, $operationId, $instanceId)
    {
        $entity = $this->getEntity($instanceId);
        
        return $this->createView($entity, array($this->name));
    }
}
