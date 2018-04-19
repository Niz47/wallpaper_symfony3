<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\Wallpaper;
use AppBundle\Service\FileMover;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class WallpaperUploadListener
{
    /**
     * @var FileMover
     */
    private $fileMover;

    public function __construct(FileMover $fileMover)
    {
        $this->fileMover = $fileMover;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        // return false if not wallpaper entity
        if (false === $eventArgs->getEntity() instanceof Wallpaper) return false;

        // got it
//        $this->fileMover->move();
        return true;
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        // TODO: write logic here
    }
}
