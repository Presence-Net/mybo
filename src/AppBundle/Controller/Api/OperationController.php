<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations\View;

use AppBundle\Entity\Operation;

class OperationController extends ApiController
{
    public function __construct() {
        $this->class = 'Operation';
        $this->parentField = 'category';
    }
    
    /**
     * @View()
     */
    public function cgetAction($categoryId)
    {
        $entities = $this->getEntities($categoryId);
        
        return $this->createView($entities);
    }
    
    /**
     * @View()
     */
    public function getAction($categoryId, $operationId)
    {
        $entity = $this->getEntity($operationId);
        
        return $this->createView($entity);
    }
}
