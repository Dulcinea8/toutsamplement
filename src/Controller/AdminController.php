<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use App\Entity\Relations;
use App\Entity\Albums;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
    * @Route("/admin/requete_insertion", name="requete-insertion")
    */
    public function requete(){
    	$repositoryRelations = $this->getDoctrine()->getRepository(Relations::class);
    	$repositoryAlbums = $this->getDoctrine()->getRepository(Albums::class);
        $requetes = $repositoryRelations->getNonValidated();
        $albums= $repositoryAlbums->findAlbumByRequete($requetes);
    	return $this->render('admin/requete_insertion.html.twig', ['requetes'=>$requetes, 'albums'=>$albums]);
    }
}
