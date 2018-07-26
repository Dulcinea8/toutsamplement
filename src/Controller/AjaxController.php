<?php

namespace App\Controller;

use App\Entity\Artistes;
use App\Entity\Tracks;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
    /**
     * @Route("/ajax/search-by-track-and-artiste/{recherche}", name="ajax-search-by-track-and-artiste", requirements={"recherche"="\w+"})
     */
    public function searchByTitle($recherche)
    {
        //j'ai récupéré l'utilisateur sélectionné grace à mon paramètre {id} dans la route et au paramaConverter

        $repository = $this->getDoctrine()->getRepository(Tracks::class);
        $tracks = $repository->searcheTrack($recherche);

        //$repository = $this->getDoctrine()->getRepository(Artistes::class);
        //$artistes = $repository->searcheArtist($recherche);

        dump($tracks);
        //dump($artistes);
        return $this->render('layout.html.twig', [
            'tracks' => $tracks,
        ]);
    }
}
