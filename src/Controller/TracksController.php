<?php

namespace App\Controller;

use App\Entity\Relations;
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

    /**
     * @Route("/track/recherche/{id}", name="rechercheByTrack-showTrack", requirements={"id"="[0-9]+"})
     */
    public function detail($id){


        $repository = $this->getDoctrine()->getRepository(Relations::class);

        $track = $repository->findByIdTrack($id);
        $id = $track['0']->getId();
        $repository = $this->getDoctrine()->getRepository(Relations::class);
        $sample = $repository->find($id);

        if(!$sample){
            throw $this->createNotFoundException('No article found for id' .$id);
        }

        dump($sample);

        return $this->render('tracks/showTrack.html.twig',  array('sample'=>$sample));

    }
}
