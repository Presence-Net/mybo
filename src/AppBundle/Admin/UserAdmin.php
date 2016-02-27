<?php

namespace AppBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;

use Symfony\Component\Intl\Intl;

class UserAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('first_name')
            ->add('last_name')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('expired')
            ->add('country')
            ->add('locale')
            ->add('currency')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('first_name')
            ->add('last_name')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('expired')
            ->add('country')
            ->add('locale')
            ->add('currency')
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
            ->add('first_name')
            ->add('last_name')
            ->add('email')
            ->add('enabled')
            ->add('country', CountryType::class, [
                'data' => 'CA',
            ])
            ->add('locale', LocaleType::class, [
                'data' => 'en_CA',
            ])
            ->add('currency', CurrencyType::class, [
                'data' => 'CAD',
            ])
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('first_name')
            ->add('last_name')
            ->add('email')
            ->add('enabled')
            ->add('locked')
            ->add('expired')
            ->add('roles')
            ->add('country')
            ->add('locale')
            ->add('currency')
        ;
    }
}
