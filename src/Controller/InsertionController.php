<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


use App\Entity\Users;
use App\Entity\Artistes;
use App\Entity\Albums;
use App\Entity\Tracks;

class InsertionController extends Controller
{
    /**
     * @Route("/inserer", name="inserer")
     */
    public function index(Request $request)
    {
    	if ($request->request->all()){

    		$entityManager = $this->getDoctrine()->getManager();
    		 $repositoryArtistes = $this->getDoctrine()->getRepository(Artistes::class);
    		 $repositoryAlbums = $this->getDoctrine()->getRepository(Albums::class);
    		 $repositoryTracks = $this->getDoctrine()->getRepository(Tracks::class);

    		if (!$repositoryArtistes->findArtisteByNom($request->request->get('artisteSample')) ) {
    			$artisteSample= new Artistes();
    			$artisteSample->setNom($request->request->get('artisteSample'));
    			$artisteSample->setGenre($request->request->get('genreSample'));
    			$entityManager->persist($artisteSample);
    		}else{
    			$artisteSample= $repositoryArtistes->findArtisteByNom($request->request->get('artisteSample'));
    		}

    		if(!$repositoryAlbums->findAlbumByNom($request->request->get('albumSample')) ){
    			$albumSample= new Albums();
    			$albumSample->setNom($request->request->get('albumSample'));
    			$albumSample->setAnnee($request->request->get('dateSample'));
    			$albumSample->setIdartiste($artisteSample);
    			$entityManager->persist($albumSample);
    		}else{
    			$albumSample= $repositoryAlbums->findAlbumByNom($request->request->get('albumSample'));
    		}


    		if (!$repositoryTracks->findTrackByTitre($request->request->get('titreSample'))) {
    			$trackSample= new Tracks;
    			$trackSample->setTitre($request->request->get('titreSample'));
    			$trackSample->setLien($request->request->get('lienSample'));
    			$trackSample->setIdalbum($albumSample);
    			$trackSample->setIsValidated(0);
    			$entityManager->persist($trackSample);
    		}else{
    			$trackSample= $repositoryAlbums->findAlbumByNom($request->request->get('titreSample'));
    		}

    		if (!$repositoryArtistes->findArtisteByNom($request->request->get('artisteSampleur')) ) {
    			$artisteSampleur= new Artistes();
    			$artisteSampleur->setNom($request->request->get('artisteSampleur'));
    			$artisteSampleur->setGenre($request->request->get('genreSampleur'));
    			$entityManager->persist($artisteSampleur);
    		}else{
    			$artisteSampleur= $repositoryArtistes->findArtisteByNom($request->request->get('artisteSampleur'));
    		}

    		if(!$repositoryAlbums->findAlbumByNom($request->request->get('albumSampleur')) ){
    			$albumSampleur= new Albums();
    			$albumSampleur->setNom($request->request->get('albumSampleur'));
    			$albumSampleur->setAnnee($request->request->get('dateSampleur'));
    			$albumSampleur->setIdartiste($artisteSampleur);
    			$entityManager->persist($albumSampleur);
    		}else{
    			$albumSampleur= $repositoryAlbums->findAlbumByNom($request->request->get('albumSampleur'));
    		}

    		if (!$repositoryTracks->findTrackByTitre($request->request->get('titreSampleur'))) {
    			$trackSampleur= new Tracks;
    			$trackSampleur->setTitre($request->request->get('titreSampleur'));
    			$trackSampleur->setLien($request->request->get('lienSampleur'));
    			$trackSampleur->setIdalbum($albumSampleur);
    			$trackSampleur->setIsValidated(0);
    			$entityManager->persist($trackSampleur);
    		}else{
    			$trackSampleur= $repositoryAlbums->findAlbumByNom($request->request->get('titreSampleur'));
    		}


            $entityManager->flush();

    	}
        return $this->render('insertion/inserer.html.twig', [
            'controller_name' => 'InsertionController',
        ]);
    }

   
}
