<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Users;
use App\Entity\Artistes;
use App\Entity\Albums;
use App\Entity\Tracks;
use App\Entity\Relations;


class ArtistesController extends Controller
{
    /**
     * @Route("/artistes", name="artistes")
     */
    public function index()
    {
        return $this->render('artistes/index.html.twig', [
            'controller_name' => 'ArtistesController',
        ]);
    }

    /**
    * @Route("/artiste/{id}", name="fiche-artiste", requirements={"\d+"})
    */
    public function ficheArtiste($id){
    	$entityManager = $this->getDoctrine()->getManager();
        $repositoryArtistes = $this->getDoctrine()->getRepository(Artistes::class);
        $repositoryAlbums = $this->getDoctrine()->getRepository(Albums::class);
        $repositoryTracks = $this->getDoctrine()->getRepository(Tracks::class);
        $repositoryRelations = $this->getDoctrine()->getRepository(Relations::class);

        $artiste= $repositoryArtistes->findOneById($id);
        $albums= $repositoryArtistes->find($artiste);

        return $this->render('artistes/fiche_artiste.html.twig', [
        	'artiste'=>$artiste,
        	'albums'=>$albums,
        ]);

    }
}
