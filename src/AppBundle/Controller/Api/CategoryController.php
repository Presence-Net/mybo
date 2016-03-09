<?php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Util\Codes;

use AppBundle\Entity\Category;

class CategoryController extends ApiCrudController
{
    public function __construct() {
        $this->class = 'Category';
        $this->name = 'category';
        $this->plural = 'categories';
        
        parent::__construct();
    }
    
    /**
     * Collection get action
     * @var Request $request
     * @return array
     */
    public function cgetAction()
    {
        $entities = $this->getEntities();
        
        return $this->createView($entities, array($this->plural));
    }

    /**
     * Get action
     * @var integer $id Id of the entity
     * @return array
     */
    public function getAction($categoryId)
    {
        $entity = $this->getEntity($categoryId);
        
        return $this->createView($entity, array($this->name));
    }

}
