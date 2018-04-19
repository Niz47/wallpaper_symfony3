<?php

namespace AppBundle\Event\Listener;

use AppBundle\Entity\Wallpaper;
use AppBundle\Service\LocalFileSystemFileMover;
use AppBundle\Service\WallpaperFilePathHelper;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

class WallpaperUploadListener
{
    /**
     * @var LocalFileSystemFileMover
     */
    private $fileMover;
    /**
     * @var WallpaperFilePathHelper
     */
    private $wallpaperFilePathHelper;

    public function __construct(LocalFileSystemFileMover $fileMover, WallpaperFilePathHelper $wallpaperFilePathHelper)
    {
        $this->fileMover = $fileMover;
        $this->wallpaperFilePathHelper = $wallpaperFilePathHelper;
    }

    public function prePersist(LifecycleEventArgs $eventArgs)
    {
        $entity = $eventArgs->getEntity();
        // return false if not wallpaper entity
        if (false === $eventArgs->getEntity() instanceof Wallpaper) return false;

        /**
         * @var $entity Wallpaper
         */

        $file = $entity->getFile();
        $temporaryLocation = $file->getPathname();
        $newFileLocation = $this->wallpaperFilePathHelper->getNewFilePath($file->getClientOriginalName());

        // To do :
        // 1 - move the uploaded file
        $this->fileMover->move($temporaryLocation, $newFileLocation);

        // 2 - update the entity with additional information
        [
            0 => $width,
            1 => $height
        ] = getimagesize($newFileLocation);

        $entity
            ->setFilename($file->getClientOriginalName())
            ->setWidth($width)
            ->setHeight($height)
        ;

        return true;
    }

    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        // TODO: write logic here
    }
}
