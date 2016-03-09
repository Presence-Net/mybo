<?php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Util\Codes;

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
    
    /**
     * Collection get action
     * @var Request $request
     * @return array
     */
    public function cgetAction($categoryId)
    {
        $entities = $this->getEntities($categoryId);
        
        return $this->createView($entities, array($this->plural));
    }

    /**
     * Get action
     * @var integer $id Id of the entity
     * @return array
     */
    public function getAction($categoryId, $operationId)
    {
        $entity = $this->getEntity($operationId);
        
        return $this->createView($entity, array($this->name));
    }
}
