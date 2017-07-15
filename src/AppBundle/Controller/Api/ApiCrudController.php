<?php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Util\Codes;

class ApiCrudController extends ApiController
{
    protected $entityNamespace = '\AppBundle\Entity\\';
    protected $name = null;
    protected $plural = null;
    
    public function __construct() {
    }

    /**
     * Get action
     * @var integer $id Id of the entity
     * @return array
     */
    public function getAction($id)
    {
        $entity = $this->getEntity($id);
        
        return $this->createView($entity, array($this->name));
    }
    
}