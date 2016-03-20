<?php

namespace AppBundle\Controller\Api;

use Symfony\Component\HttpFoundation\Request;

use FOS\RestBundle\Util\Codes;

class ApiCrudController extends ApiController
{
    protected $entityNamespace = '\AppBundle\Entity\\';
    protected $formTypeNamespace = '\AppBundle\Form\\';
    protected $formType = null;
    protected $name = null;
    protected $plural = null;
    
    public function __construct() {
        $this->formType = $this->class . 'Type';
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
    
    /**
     * Collection post action
     * @var Request $request
     * @return View|array
     */
    public function cpostAction(Request $request)
    {
        $class = $this->entityNamespace.$this->class;
        $entity = new $class();
        
        $formType = $this->formTypeNamespace.$this->formType;
        $form = $this->createForm(new $formType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
            
            return $this->createView($entity, array($this->name));
        }

        return array(
            'form' => $form,
        );
    }
    
    /**
     * Put action
     * @var Request $request
     * @var integer $id Id of the entity
     * @return View|array
     */
    public function putAction(Request $request, $id)
    {
        $entity = $this->getEntity($id);

        $formType = $this->formTypeNamespace.$this->formType;
        $form = $this->createForm(new $formType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->view(null, Codes::HTTP_NO_CONTENT);
        }

        return array(
            'form' => $form,
        );
    }

    /**
     * Delete action
     * @var integer $id Id of the entity
     * @return View
     */
    public function deleteAction($id)
    {
        $entity = $this->getEntity($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($entity);
        $em->flush();

        return $this->view(null, Codes::HTTP_NO_CONTENT);
    }
}