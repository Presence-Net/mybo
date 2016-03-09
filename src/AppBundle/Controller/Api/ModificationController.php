<?php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Util\Codes;

use AppBundle\Entity\InstanceModification;

class ModificationController extends ApiCrudController
{
    public function __construct() {
        $this->class = 'InstanceModification';
        $this->name = 'modification';
        $this->plural = 'modifications';
        $this->parentField = 'instance';
        
        parent::__construct();
    }
    
    /**
     * Collection get action
     * @var Request $request
     * @return array
     */
    public function cgetAction(Request $request, $categoryId, $operationId, $instanceId)
    {
        $entities = $this->getEntities($instanceId);
        
        return $this->createView($entities, array($this->plural));
    }

    /**
     * Get action
     * @var integer $id Id of the entity
     * @return array
     */
    public function getAction($categoryId, $operationId, $instanceId, $modificationId)
    {
        $entity = $this->getEntity($modificationId);
        
        return $this->createView($entity, array($this->name));
    }
}
