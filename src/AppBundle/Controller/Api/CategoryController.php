<?php

namespace AppBundle\Controller\Api;

use AppBundle\Entity\Category;

class CategoryController extends ApiCrudController
{
    public function __construct() {
        $this->class = 'Category';
        $this->name = 'category';
        $this->plural = 'categories';
        $this->parentField = null;
        
        parent::__construct();
    }
    
    /**
     * Get action
     * @var integer $id Id of the entity
     * @return array
     */
    public function cgetAction()
    {
        $entities = $this->getEntities();
        
        return $this->createView($entities, array($this->plural));
    }
    
    public function getOperationsAction($id)
    {
        $entity = $this->getEntity($id);
        
        return $this->createView($entity->getOperations(), array('operations'));
    }

}
