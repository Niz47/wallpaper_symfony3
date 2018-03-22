<?php

namespace AppBundle\DataFixtures\ORM;

/**
 * Created by PhpStorm.
 * User: zinmarhtun
 * Date: 3/22/2018
 * Time: 1:18 PM
 */

use AppBundle\Entity\Category;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $category = (new Category())
            ->setName('Abstract');

        $this->addReference('category.abstract', $category);

        $manager->persist($category);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        // TODO: Implement getOrder() method.
        return 100;
    }
}