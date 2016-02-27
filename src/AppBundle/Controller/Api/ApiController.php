<?php

namespace AppBundle\Controller\Api;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Routing\ClassResourceInterface;


class ApiController extends FOSRestController implements ClassResourceInterface {

    protected $class = null;
    protected $parentField = null;
    
    protected function createView($data)
    {
        return \FOS\RestBundle\View\View::create()
            ->setStatusCode(200)
            ->setData($data);
    }

    /**
     * Get entity instance
     * @var integer $id Id of the entity
     * @return Container
     */
    protected function getEntity($id = null) {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('AppBundle:' . $this->class);
        if ($id) {
            $entity = $repo->find($id);
        }
        else {
            $entity = $repo->findAll();
        }

        if (!$entity) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Unable to find ' . $this->class . ' entity');
        }

        return $entity;
    }

    /**
     * Get array of entity instance
     * @var integer $id Id of the entity
     * @return $objectClass object
     */
    protected function getEntities($parentId = null) {
        $em = $this->getDoctrine()->getManager();

        $repo = $em->getRepository('AppBundle:' . $this->class);
        if ($parentId) {
            $entities = $repo->findBy([$this->parentField => $parentId]);
        }
        else {
            $entities = $repo->findAll();
        }

        if (!$entities) {
            throw new \Symfony\Component\HttpKernel\Exception\NotFoundHttpException('Unable to find ' . $this->class . ' entities');
        }

        return $entities;
    }

}
