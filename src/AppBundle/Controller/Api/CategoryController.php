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
    
    public function getOperationsAction($id)
    {
        $entity = $this->getEntity($id);
        
        return $this->createView($entity->getOperations(), array('operations'));
    }

}
