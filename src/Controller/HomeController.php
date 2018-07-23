<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Artistes;
use App\Entity\Articles;

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
        $artistes = $repositoryArtistes->last5Artistes();

        $repositoryArticles = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repositoryArticles->last5Articles();

        // $repositorySamples = $this->getDoctrine()->getRepository(Sample::class);
        // $samples = $repositorySamples->findAll();

        return $this->render('home/index.html.twig', array('artistes'=>$artistes, 'articles'=>$articles));
    }

}
