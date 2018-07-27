<?php

namespace App\Controller;

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
        dump($recherche);
        if(!$recherche){
            return new Response('titre invalide');
        }
        $repository = $this->getDoctrine()->getRepository(Tracks::class);
        $tracks = $repository->searchTrack($recherche);

        //$repository = $this->getDoctrine()->getRepository(Artistes::class);
        //$artistes = $repository->searchArtist($recherche);

        dump($artistes);
        //dump($artistes);
        return $this->render('layout.html.twig', [
            'tracks' => $tracks,
        ]);
    }
}
