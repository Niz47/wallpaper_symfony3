<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DetailController extends Controller
{
    /**
     * @Route("/view", name="view")
     */
    public function indexAction()
    {
        $image = 'Summer_valley_in_Proteus.png';

        return $this->render('detail/index.html.twig', [
            'image' => $image
        ]);
    }
}
