<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\LocaleType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;

use Symfony\Component\Intl\Intl;

class RegistrationFormType extends AbstractType
{
    private $container;
    private $session;
    
    public function __construct($class, $container, $session)
    {
        $this->container = $container;
        $this->session = $session;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // add your custom field
        $builder->add('first_name');
        $builder->add('last_name');
        $builder->add('country', CountryType::class, [
            'data' => 'CA',
        ]);
        $builder->add('locale', LocaleType::class, [
            'data' => 'en_CA',
        ]);
        $builder->add('currency', CurrencyType::class, [
            'data' => 'CAD',
        ]);

        $builder->remove('username');
    }

    public function getParent()
    {
        return 'fos_user_registration';
    }

    public function getName()
    {
        return 'app_registration';
    }
}