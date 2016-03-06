<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations\View;

use AppBundle\Entity\Category;

class CategoryController extends ApiController
{
    public function __construct() {
        $this->class = 'Category';
        $this->parentField = null;
    }
    
    /**
     * @View(serializerGroups={"api"})
     */
    public function cgetAction()
    {
        $entities = $this->getEntities();
        
        return $this->createView($entities);
    }
    
    /**
     * @View(serializerGroups={"api"})
     */
    public function getAction($categoryId)
    {
        $entity = $this->getEntity($categoryId);
        
        return $this->createView($entity);
    }
}
