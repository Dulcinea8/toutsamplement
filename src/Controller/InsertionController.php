<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;


use App\Entity\Users;
use App\Entity\Artistes;
use App\Entity\Albums;
use App\Entity\Tracks;
use App\Entity\Relations;

class InsertionController extends Controller
{
    /**
     * @Route("/inserer", name="inserer")
     */
    public function index(Request $request, FileUploader $uploader)
    {

        $this->denyAccessUnlessGranted('ROLE_USER');

        $entityManager = $this->getDoctrine()->getManager();
        $repositoryArtistes = $this->getDoctrine()->getRepository(Artistes::class);
        $repositoryAlbums = $this->getDoctrine()->getRepository(Albums::class);
        $repositoryTracks = $this->getDoctrine()->getRepository(Tracks::class);
        $repositoryRelations = $this->getDoctrine()->getRepository(Relations::class);

    $AjaxArtiste= $repositoryArtistes->findAll();
    $AjaxAlbum= $repositoryAlbums->findAll();
    $AjaxTrack= $repositoryTracks->findAll();

    	$msg="";
    	if ($request->request->all()){

    		if (!$repositoryArtistes->findArtisteByNom($request->request->get('artisteSample')) ) {
    			$artisteSample= new Artistes();
    			$artisteSample->setNom($request->request->get('artisteSample'));
    			$artisteSample->setGenre($request->request->get('genreSample'));
                $artisteSample->setIsValidated(0);
    			$entityManager->persist($artisteSample);
    		}else{
    			$artisteSample= $repositoryArtistes->findArtisteByNom($request->request->get('artisteSample'));
    		}

    		if(!$repositoryAlbums->findAlbumByNom($request->request->get('albumSample')) ){
    			$albumSample= new Albums();
    			$albumSample->setNom($request->request->get('albumSample'));
    			$albumSample->setAnnee($request->request->get('dateSample'));
    			$albumSample->setIdartiste($artisteSample);
                $albumSample->setIsValidated(0);
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
    			$trackSample= $repositoryTracks->findTrackByTitre($request->request->get('titreSample'));
    		}

    		if (!$repositoryArtistes->findArtisteByNom($request->request->get('artisteSampleur')) ) {
    			$artisteSampleur= new Artistes();
    			$artisteSampleur->setNom($request->request->get('artisteSampleur'));
    			$artisteSampleur->setGenre($request->request->get('genreSampleur'));
                $artisteSampleur->setIsValidated(0);
    			$entityManager->persist($artisteSampleur);
    		}else{
    			$artisteSampleur= $repositoryArtistes->findArtisteByNom($request->request->get('artisteSampleur'));
    		}

    		if(!$repositoryAlbums->findAlbumByNom($request->request->get('albumSampleur')) ){
    			$albumSampleur= new Albums();
    			$albumSampleur->setNom($request->request->get('albumSampleur'));
    			$albumSampleur->setAnnee($request->request->get('dateSampleur'));
    			$albumSampleur->setIdartiste($artisteSampleur);
                $albumSampleur->setIsValidated(0);
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
    			$trackSampleur= $repositoryTracks->findTrackByTitre($request->request->get('titreSampleur'));
    		}

            $idSampleur= $trackSampleur->getId();
            $idOriginal= $trackSample->getId();

            if (!$repositoryRelations->doesRelationExist($idSampleur, $idOriginal)) {
                $relation= new Relations;
                $relation->setSampleur($trackSampleur);
                $relation->setOriginal($trackSample);
                $relation->setIsValidated(0);
                $relation->setUser($this->getUser());
                $entityManager->persist($relation);
            }

    		$entityManager->flush();
    			$msg='Merci pour votre contribution ! Elle sera examinée par un admin avant validation';
    		
            

    	}
        return $this->render('insertion/inserer.html.twig', [
            'controller_name' => 'InsertionController',
            'msg'=>$msg,
            'AjaxArtiste'=>$AjaxArtiste,
            'AjaxAlbum'=>$AjaxAlbum,
            'AjaxTrack'=>$AjaxTrack,
        ]);
    }

   
}
