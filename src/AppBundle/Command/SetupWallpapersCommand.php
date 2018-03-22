<?php

namespace AppBundle\Command;

use AppBundle\Entity\Wallpaper;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class SetupWallpapersCommand extends Command
{
    private $rootDir;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(String $rootDir, EntityManagerInterface $em)
    {
        parent::__construct();
        $this->rootDir = $rootDir;
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setName('app:setup-wallpapers')
            ->setDescription('Grab all the local wallpapers and create a wallpaper entity for each one');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);

        $wallpapers = glob($this->rootDir . '/../web/images/*.*');
        $wallpaperCount = count($wallpapers);
//        exit(\Doctrine\Common\Util\Debug::dump($wallpapers));

        $io->title('Importing wallpapers');
        $io->progressStart($wallpaperCount);

        $filenames = [];

        foreach ($wallpapers as $wallpaper) {
//            exit(\Doctrine\Common\Util\Debug::dump(pathinfo($wallpaper)));

            [
                'basename' => $filename,
                'filename' => $slug,
            ] = pathinfo($wallpaper);

            [
                '0' => $width,
                '1' => $height,
            ] = getimagesize($wallpaper);

//            exit(\Doctrine\Common\Util\Debug::dump(getimagesize($wallpaper)));

            $wp = (new Wallpaper())
                ->setFilename($filename)
                ->setSlug($slug)
                ->setWidth($width)
                ->setHeight($height);

            $filenames[] = [$filename];

            $this->em->persist($wp);
            $io->progressAdvance();
        }
        $this->em->flush();
        $io->progressFinish();

        $table = new Table($output);
        $table -> setHeaders(['Filename'])
               -> setRows($filenames);
        $table -> render();

        $io->success(sprintf('Cool, wp added %d wallpaper', $wallpaperCount));
//        $output->writeln('Command result.');
    }

}
