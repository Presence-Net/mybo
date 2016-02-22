<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use AppBundle\Entity\Operation;

class OperationAdmin extends Admin
{
    protected $translationDomain = 'SonataPageBundle'; // default is 'messages'
    
    var $recurrenceChoices = [
        Operation::RECUR_ADJUSTBALANCE => Operation::RECUR_ADJUSTBALANCE,
        Operation::RECUR_ONCE => Operation::RECUR_ONCE,
        Operation::RECUR_DAILY => Operation::RECUR_DAILY,
        Operation::RECUR_WEEKLY => Operation::RECUR_WEEKLY,
        Operation::RECUR_MONTHLY => Operation::RECUR_MONTHLY,
        Operation::RECUR_YEARLY => Operation::RECUR_YEARLY,
    ];
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('user')
            ->add('category')
            ->add('name')
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
            ->add('icon')
            ->add('name')
            ->add('description')
            ->add('amount')
            ->add('startDate')
            ->add('endDate')
            ->add('recurrence')
            ->add('recurrenceInterval')
            ->add('count')
            ->add('days')
            ->add('user')
            ->add('category')
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
            ->add('category')
            ->add('name')
            ->add('description', 'text', array('required' => false))
            ->add('amount')
            ->add('startDate', 'sonata_type_date_picker')
            ->add('endDate', 'sonata_type_date_picker', array('required' => false))
            ->add('recurrence', 'choice', array(
                'choices' => $this->recurrenceChoices,
            ))
            ->add('recurrenceInterval')
            ->add('count')
            ->add('days', 'text', array('required' => false))
            ->add('icon', 'sonata_type_model_list', array(), array('link_parameters' => array('context' => 'operation')))
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
            ->add('category')
            ->add('name')
            ->add('description')
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
