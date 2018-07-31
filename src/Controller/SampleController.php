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
    public function showAllSamples(){

        $repositorySamples = $this->getDoctrine()->getRepository(Relations::class);

        $samples = $repositorySamples->lastSamples();

        //requete pour recuperer les genres
        $repositoryArtistes = $this->getDoctrine()->getRepository(Artistes::class);
        //$genres = $repositoryArtistes->findGenres();

        return $this->render('sample/samples.html.twig', array(
            'samples'=>$samples/*'genres'=>$genres*/));

    }

    /**
     * @Route("/ajax/genre/", name="search-by-genre", requirements={"genre"="[A-z][0-9]+"})
     */
    public function searchByGenre(Artistes $artiste)
    {
        //j'ai recupere l'artiste grace a mon parametre {genre}
        $repository = $this->getDoctrine()->getRepository(Artistes::class);
        //on rajoute a la suite de findBy le nom de la propriété par laquelle on fait la recherche
        //doctrine va comprendre et faire la requete appropriée
        $artistes = $repository->findByGenre($artiste);

        return $this->render('ajax/genre.html.twig', [
            'artistes' => $artistes,
        ]);
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
