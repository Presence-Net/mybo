<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class OperationModificationAdmin extends Admin
{
    protected $translationDomain = 'SonataPageBundle'; // default is 'messages'
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('user')
            ->add('operation')
            ->add('oldDate', null, [], 'sonata_type_date_picker')
            ->add('newDate', null, [], 'sonata_type_date_picker')
            ->add('oldAmount')
            ->add('newAmount')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('user')
            ->add('operation')
            ->add('oldDate')
            ->add('newDate')
            ->add('oldAmount')
            ->add('newAmount')
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
            ->add('user')
            ->add('operation')
            ->add('oldDate', 'sonata_type_date_picker', array('required' => false))
            ->add('newDate', 'sonata_type_date_picker', array('required' => false))
            ->add('oldAmount', 'text', array('required' => false))
            ->add('newAmount', 'text', array('required' => false))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('user')
            ->add('operation')
            ->add('oldDate')
            ->add('newDate')
            ->add('oldAmount')
            ->add('newAmount')
        ;
    }
}
