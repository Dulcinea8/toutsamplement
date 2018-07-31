<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Entity\Artistes;
use App\Entity\Tracks;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
    /**
     * @Route("/ajax/search", name="ajax-search" )
     */
    public function searchByTrackArtist(Request $request)
    {

        //$get = $request->query->all();
        $recherche=$request->query->get('recherche', null);
        //dump($recherche);

        $repository = $this->getDoctrine()->getRepository(Tracks::class);
        $tracks = $repository->searchTrack($recherche);


        $repository = $this->getDoctrine()->getRepository(Artistes::class);
        $artistes = $repository->searchArtist($recherche);

        //dump($artistes);
        //dump($artistes);
        return $this->render('ajax/search.html.twig', [
            'tracks' => $tracks, 'artistes' => $artistes
        ]);
    }

    /**
     * @Route("/ajax/search-by-genre/", name="ajax-search-by-genre")
     */
    public function searchByGenre(Artistes $artiste)
    {
        //j'ai recupere l'artiste grace a mon parametre {genre}
        $repository = $this->getDoctrine()->getRepository(Artistes::class);
        //on rajoute a la suite de findBy le nom de la propriété par laquelle on fait la recherche
        //doctrine va comprendre et faire la requete appropriée
        $artistes = $repository->findByGenre($artiste);

        return $this->render('ajax/samples.html.twig', [
            'artistes' => $artistes,
        ]);
    }
}
