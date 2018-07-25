<?php

namespace App\Controller;

use App\Entity\Relations;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Artistes;
use App\Entity\Articles;
use App\Entity\Tracks;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/", name="accueil")
     */
    public function accueil()
    {

        $repositoryArtistes = $this->getDoctrine()->getRepository(Artistes::class);
        $artistes = $repositoryArtistes->last4Artistes();

        $repositoryArticles = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repositoryArticles->last4Articles();

        $repositorySamples = $this->getDoctrine()->getRepository(Relations::class);
        $samples = $repositorySamples->last4Samples();

        // $repositoryTracks = $this->getDoctrine()->getRepository(Tracks::class);
        // $tracks = $repositoryTracks->findTrackById($samples);


        return $this->render('home/index.html.twig', array(
                                                            'artistes'=>$artistes,
                                                            'articles'=>$articles,
                                                            'samples'=>$samples));
    }

}
