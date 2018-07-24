<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InsertionController extends Controller
{
    /**
     * @Route("/insertion", name="insertion")
     */
    public function index()
    {
        return $this->render('insertion/index.html.twig', [
            'controller_name' => 'InsertionController',
        ]);
    }
}
