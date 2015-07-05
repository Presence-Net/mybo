<?php

namespace AppBundle\Menu;

use Knp\Menu\FactoryInterface;
use Symfony\Component\DependencyInjection\ContainerAware;

class Builder extends ContainerAware
{
	protected function addLocale($menu)
	{
		$request = $this->container->get('request');
		$route = $request->get('_route');
		$route_params = $request->get('_route_params');

		$locales = $this->container->getParameter('lunetics_locale.allowed_locales');
		foreach($locales as $lang) {
			if($lang !== $request->get('_locale')) {
	    		$menu->addChild($lang, array(
	    				'uri' => $this->container->get('router')->generate($route,array_merge($route_params, array('_locale' => $lang))),
	    				'attributes' => array(
	    				),
	    				'linkAttributes' => array(
	    						'class' => 'item',
	    				),
	    		));
	    	}
        }

		return $menu;
	}

    public function mainMenu(FactoryInterface $factory, array $options)
    {
        $trans = $this->container->get('translator');
        $request = $this->container->get('request');
        $locale = $request->getLocale();
        $securityContext = $this->container->get('security.context');
        $route = $request->get('_route');
        $route_params = $request->get('_route_params');
        
        $options['currentClass'] = 'active';
    	
        $menu = $factory->createItem('root', array(
        	'attributes' => array(
        		'class' => 'ui pointing menu',
        	),
        	'class' => 'ui pointing menu',
        ));

        $children_attributes = $menu->getChildrenAttributes();
        $menu_class = 'ui pointing menu';
        
        if(isset($children_attributes['class'])) $menu_class .= $children_attributes['class'];
        $menu->setChildrenAttributes(array('class' => $menu_class));

        if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
	        $menu->addChild($trans->trans('Budget'), array(
	       		'route' => 'budget_home',
	            'attributes' => array(
	            ),
	       		'linkAttributes' => array(
	       			'class' => 'item',
	       		),
	       		'extras' => array(
	       			'item-icon' => 'info icon',
	       		),
	        ));

	        $menu->addChild($trans->trans('Calendar'), array(
	       		'route' => 'budget_calendar',
	            'attributes' => array(
	            ),
	       		'linkAttributes' => array(
	       			'class' => 'item',
	       		),
	       		'extras' => array(
	       			'item-icon' => 'calendar icon',
	       		),
	        ));

	        $menu->addChild($trans->trans('Details'), array(
	       		'route' => 'budget_details',
	            'attributes' => array(
	            ),
	       		'linkAttributes' => array(
	       			'class' => 'item',
	       		),
	       		'extras' => array(
	       			'item-icon' => 'list icon',
	       		),
	        ));

	        $menu->addChild($trans->trans('Summary'), array(
	       		'route' => 'budget_summary',
	            'attributes' => array(
	            ),
	       		'linkAttributes' => array(
	       			'class' => 'item',
	       		),
	       		'extras' => array(
	       			'item-icon' => 'pie chart icon',
	       		),
	        ));
	    }
	    else {
	        $menu->addChild($trans->trans('Home'), array(
	       		'route' => 'home',
	            'attributes' => array(
	            ),
	       		'linkAttributes' => array(
	       			'class' => 'item',
	       		),
	       		'extras' => array(
	       			'item-icon' => 'home icon',
	       		),
	        ));
	    }

        $right = $menu->addChild('right', array(
        	'label' => false,
        	'childrenAttributes' => array(
        		'class' => 'right menu',
    		),
    	));
        
		if($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
	    	$user = $securityContext->getToken()->getUser();
	    	//$user_name = $user->getFirstName() || $user->getLastName() ? $user->getFullName() : $user->getEmail();
	    	$user_name = 'Account';

	        $user_dropdown = $right->addChild('user_dropdown', array(
	        	'label' => false,
	        	'childrenAttributes' => array(
	        		'class' => 'ui dropdown item',
	    		),
	    	));
	    	$label = $user_dropdown->addChild($user_name, array(
				'attributes' => array(
				),
	       		'extras' => array(
	       			'item-icon' => 'user icon',
	       			'item-icon-after' => 'dropdown icon',
	       		),
			));
	        $user_menu = $user_dropdown->addChild('user_menu', array(
	        	'label' => false,
	        	'childrenAttributes' => array(
	        		'class' => 'menu',
	    		),
	    	));
    		$user_menu->addChild('My account', array(
    				'uri' => 'fos_user_profile_show',
    				'attributes' => array(
    				),
    				'linkAttributes' => array(
    						'class' => 'item',
    				),
    		));
    		$user_menu->addChild('My budget', array(
    				'uri' => 'budget_home',
    				'attributes' => array(
    				),
    				'linkAttributes' => array(
    						'class' => 'item',
    				),
    		));
    		$user_menu->addChild('Logout', array(
    				'route' => 'fos_user_security_logout',
    				'attributes' => array(
    				),
    				'linkAttributes' => array(
    						'class' => 'item',
    				),
    		));
        }
        else {
	        $login = $right->addChild('login', array(
	        	'label' => false,
	        	'childrenAttributes' => array(
	        		'class' => 'item',
	    		),
	    	));
        	$login->addChild($trans->trans('Login'), array(
        		'route' => 'fos_user_security_login',
                'attributes' => array(
                ),
        		'linkAttributes' => array(
        			'class' => 'ui primary button',
        		),
        	));

	        $signup = $right->addChild('signup', array(
	        	'label' => false,
	        	'childrenAttributes' => array(
	        		'class' => 'item',
	    		),
	    	));
        	$signup->addChild($trans->trans('Sign up'), array(
        		'route' => 'fos_user_registration_register',
                'attributes' => array(
                ),
        		'linkAttributes' => array(
        			'class' => 'ui primary button',
        		),
        	));
        }

        $right = $this->addLocale($right);
        
        return $menu;
    }
}
