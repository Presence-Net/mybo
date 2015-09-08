<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Category;

class LoadUserData implements FixtureInterface, ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     * 
     * @param ContainerInterface $container
     */
    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    /**
     */

    /**
     * {@inheritDoc}
     * 
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager) {
        $categories = [
            [
                'name' => 'Revenues',
                'rank' => 1,
            ],
            [
                'name' => 'Expenses',
                'rank' => 2,
                'default' => true,
            ],
            [
                'name' => 'Savings',
                'rank' => 3,
            ],
        ];

        foreach ($categories as $category) {
            $this->loadCategory($category, $manager);
        }

        $manager->flush();
    }

    /**
     * 
     * @param Array $category
     * @param ObjectManager $manager
     */
    private function loadCategory($category, ObjectManager $manager) {
        $trans = $this->container->get('translator');

        $repository = $this->container->get('doctrine')->getManager()->getRepository('Gedmo\\Translatable\\Entity\\Translation');

        $lang = 'fr';
        $domain = 'messages';

        $entity = new Category();
        $entity->setName($category['name']);
        $entity->setRank($category['rank']);
        if (isset($category['default'])) {
            $entity->setIsDefault(true);
        }

        $repository->translate($entity, 'name', $lang, $trans->trans($category['name'], [], $domain, $lang));

        $manager->persist($entity);
    }

}
