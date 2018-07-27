<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TracksController extends Controller
{
    /**
     * @Route("/tracks", name="tracks")
     */
    public function index()
    {
        return $this->render('tracks/index.html.twig', [
            'controller_name' => 'TracksController',
        ]);
    }
}
