<?php

namespace App\Controller;

use App\Entity\Relations;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Tracks;
use App\Entity\Artistes;
use App\Entity\Albums;
use App\Form\InsererTrackType;
use App\Form\InsererAlbumType;
use App\Form\InsererArtisteType;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @Route("/samples/", defaults={"page": "1"}, methods={"GET"}, name="all-samples")
     * @Route("/page/{page}",  requirements={"page": "[1-9]\d*"}, methods={"GET"}, name="all-samples_paginated")
     *
     */
    public function showAllSamples(int $page){

        $repositorySamples = $this->getDoctrine()->getRepository(Relations::class);

        $samples = $repositorySamples->lastSamples($page);

        //requete pour recuperer les genres
        $repositoryArtistes = $this->getDoctrine()->getRepository(Artistes::class);
        $genres = $repositoryArtistes->findGenres();

        return $this->render('sample/samples.html.twig', array(
            'samples'=>$samples, 'genres'=>$genres));

    }



    /**
     * @Route("/sample/{id}", name="detail-sample", requirements={"id"="[0-9]+"})
     */
    public function detail($id){

        $repository = $this->getDoctrine()->getRepository(Relations::class);

        $sample = $repository->find($id);

        if(!$sample){
            throw $this->createNotFoundException('No article found for id' .$id);
        }

        return $this->render('sample/detailsample.html.twig',  array('sample'=>$sample));

    }

}
