<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use AppBundle\Entity\Instance;

class InstanceAdmin extends Admin
{
    protected $translationDomain = 'SonataPageBundle'; // default is 'messages'
    
    var $recurrenceChoices = [
        Instance::RECUR_ADJUSTBALANCE => Instance::RECUR_ADJUSTBALANCE,
        Instance::RECUR_ONCE => Instance::RECUR_ONCE,
        Instance::RECUR_DAILY => Instance::RECUR_DAILY,
        Instance::RECUR_WEEKLY => Instance::RECUR_WEEKLY,
        Instance::RECUR_MONTHLY => Instance::RECUR_MONTHLY,
        Instance::RECUR_YEARLY => Instance::RECUR_YEARLY,
    ];
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('operation')
            ->add('amount')
            ->add('startDate', null, [], 'sonata_type_date_picker')
            ->add('endDate', null, [], 'sonata_type_date_picker')
            ->add('recurrence', null, [], 'choice', array(
                'choices' => $this->recurrenceChoices,
            ))
            ->add('recurrenceInterval')
            ->add('count')
            ->add('days')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('operation')
            ->add('amount')
            ->add('startDate')
            ->add('endDate')
            ->add('recurrence')
            ->add('recurrenceInterval')
            ->add('count')
            ->add('days')
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
            ->add('operation')
            ->add('amount')
            ->add('startDate', 'sonata_type_date_picker')
            ->add('endDate', 'sonata_type_date_picker', array('required' => false))
            ->add('recurrence', 'choice', array(
                'choices' => $this->recurrenceChoices,
            ))
            ->add('recurrenceInterval')
            ->add('count')
            ->add('days', 'text', array('required' => false))
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('operation')
            ->add('amount')
            ->add('startDate')
            ->add('endDate')
            ->add('recurrence', 'choice', array(
                'choices' => $this->recurrenceChoices,
            ))
            ->add('recurrenceInterval')
            ->add('count')
            ->add('days')
        ;
    }
}
