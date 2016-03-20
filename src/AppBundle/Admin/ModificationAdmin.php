<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ModificationAdmin extends Admin
{
    protected $translationDomain = 'SonataPageBundle'; // default is 'messages'
    
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('instance')
            ->add('oldDate', null, [], 'sonata_type_date_picker')
            ->add('newDate', null, [], 'sonata_type_date_picker')
            ->add('oldAmount')
            ->add('newAmount')
            ->add('noop')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('instance')
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
            ->add('noop')
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('instance')
            ->add('oldDate', 'sonata_type_date_picker', array('required' => false))
            ->add('newDate', 'sonata_type_date_picker', array('required' => false))
            ->add('oldAmount', 'text', array('required' => false))
            ->add('newAmount', 'text', array('required' => false))
            ->add('noop')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('instance')
            ->add('oldDate')
            ->add('newDate')
            ->add('oldAmount')
            ->add('newAmount')
            ->add('noop')
        ;
    }
}
