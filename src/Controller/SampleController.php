<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Tracks;
use App\Entity\Artistes;
use App\Entity\Albums;
use App\Form\InsererTrackType;
use App\Form\InsererAlbumType;
use App\Form\InsererArtisteType;

class SampleController extends Controller
{
    /**
     * @Route("/sample", name="sample")
     */
    public function index()
    {
        return $this->render('sample/index.html.twig', [
            'controller_name' => 'SampleController',
        ]);
    }

   
}
