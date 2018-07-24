<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InsertionController extends Controller
{
    /**
     * @Route("/inserer", name="inserer")
     */
    public function index()
    {
        return $this->render('insertion/inserer.html.twig', [
            'controller_name' => 'InsertionController',
        ]);
    }
}
