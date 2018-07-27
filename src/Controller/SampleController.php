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
     * @Route("/samples/", name="all-samples")
     */
    public function showAllSamples(Request $request){

        //$repositoryTracks = $this->getDoctrine()->getRepository(Tracks::class);

        //$tracks = $repositoryTracks->findTrackByTitre($request->request->get('titreSample'));

        $repository = $this->getDoctrine()->getRepository(Relations::class);

        $samples = $repository->findAll();

        return $this->render('sample/samples.html.twig', array('samples'=>$samples));

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
