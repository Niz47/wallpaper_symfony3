<?php
/**
 * Created by PhpStorm.
 * User: zinmarhtun
 * Date: 4/19/2018
 * Time: 4:26 PM
 */

namespace AppBundle\Service;


class WallpaperFilePathHelper
{
    /**
     * @var String
     */
    private $wallpaperFileDirectory;

    /**
     * WallpaperFilePathHelper constructor.
     * @param String $wallpaperFileDirectory
     */
    public function __construct($wallpaperFileDirectory)
    {
        $this->wallpaperFileDirectory = $wallpaperFileDirectory;
    }

    public function getNewFilePath(String $newFileName)
    {
        return $this->wallpaperFileDirectory . $newFileName;
    }
}