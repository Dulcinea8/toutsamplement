<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Tracks;
use App\Entity\Artistes;
use App\Entity\Albums;
use App\Form\InsererTrackType;
use App\Form\InsererAlbumType;
use App\Form\InsererArtisteType;

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
    * @Route("/inserer", name="inserer")
    */
    public function inserer(){
    	// $this->denyAccessunlessgranted('IS_AUTHENTICATED_FULLY');
    	$trackSample = new Tracks();
    	$albumSample = new Albums();
    	$artisteSample = new Artistes();
    	$formArSample = $this->createForm(InsererArtisteType::class, $artisteSample);
    	$formAlSample = $this->createForm(InsererAlbumType::class, $albumSample);
    	$formTrSample = $this->createForm(InsererTrackType::class, $trackSample);

    	$trackSampleur = new Tracks();
    	$albumSampleur = new Albums();
    	$artisteSampleur = new Artistes();
    	$formArSampleur = $this->createForm(InsererArtisteType::class, $artisteSampleur);
    	$formAlSampleur = $this->createForm(InsererAlbumType::class, $albumSampleur);
    	$formTrSampleur = $this->createForm(InsererTrackType::class, $trackSampleur);

    	return $this->render('sample/inserer.html.twig'
                              //   array('formArSample' => $formArSample->createview(),
                            		// 	'formAlSample'=>$formAlSample->createview(),
                            		// 	'formTrSample'=>$formTrSample->createview(),
                            		// 	'formArSampleur' => $formArSampleur->createview(),
                            		// 	'formAlSampleur'=>$formAlSampleur->createview(),
                            		// 	'formTrSampleur'=>$formTrSampleur->createview()
                            		// )
            );
    }
}
