<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class CategoryAdmin extends Admin
{
    protected $translationDomain = 'SonataPageBundle'; // default is 'messages'
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('rank')
            ->add('isDefault')
            ->add('isHidden')
            ->add('parent')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('icon')
            ->add('name')
            ->add('description')
            ->add('rank')
            ->add('isDefault')
            ->add('isHidden')
            ->add('parent')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('description')
            ->add('rank')
            ->add('isDefault')
            ->add('isHidden')
            ->add('parent')
            ->add('icon', 'sonata_type_model_list', array(), array('link_parameters' => array('context' => 'category')))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('description')
            ->add('rank')
            ->add('isDefault')
            ->add('isHidden')
            ->add('parent')
            ->add('icon')
        ;
    }
}
