<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $abstract = [
            "a1.jpg",
            "a2.jpg",
            "a3.jpg",
            "a4.jpg",
            "a5.jpg"
        ];
        $summer = [
            "s1.jpg",
            "s2.jpg",
            "s3.jpg",
            "s4.jpg",
            "s5.jpg"
        ];
        $winter = [
            "w1.jpg",
            "w2.jpg",
            "w3.jpg",
            "w4.jpg",
            "w5.jpg"
        ];

        $images = array_merge($abstract, $summer, $winter);
        shuffle($images);
        $randomiseImages = array_slice($images, 0, 8);

        return $this->render('home/index.html.twig', [
            'randomiseImages' => $randomiseImages,
            'abstract' => array_slice($abstract, 0, 2),
            'summer' => array_slice($summer, 0, 2),
            'winter' => array_slice($winter, 0, 2)
        ]);
    }
}
