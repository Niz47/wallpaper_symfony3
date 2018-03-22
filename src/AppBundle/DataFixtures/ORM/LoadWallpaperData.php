<?php

namespace AppBundle\DataFixtures\ORM;

/**
 * Created by PhpStorm.
 * User: zinmarhtun
 * Date: 3/22/2018
 * Time: 1:18 PM
 */

use AppBundle\Entity\Wallpaper;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadWallpaperData extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $wallpaper = (new Wallpaper())
            ->setFilename('a1.jpg')
            ->setSlug('a1')
            ->setWidth(1920)
            ->setHeight(1080)
            ->setCategory($this->getReference('category.abstract'));

//        exit(\Doctrine\Common\Util\Debug::dump($wallpaper));

        $manager->persist($wallpaper);
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
        return 200;
    }
}