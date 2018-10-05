<?php

namespace App\Controller;


use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
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

    /**
     * @Route("/show/artistes", name="liste-artistes")
     */
    public function listeArtistes()
    {
        $repository = $this->getDoctrine()->getRepository(Artistes::class);

        $liste=$repository->findAll();
        return $this->render('artistes/listeArtistes.html.twig', array('artistes'=>$liste));

    }

    /**
     * @Route("/update/artiste/{id}", name="artiste-update", requirements={"id"="\d+"})
     */
    public function updateArtiste(Artistes $artiste, Request $request)
    {

        $form = $this->createFormBuilder($artiste)
            ->add('nom', TextType::class,array('label'=>'Nom', 'required'=>true))
            ->add('genre', ChoiceType::class, array(
                'choices'  => array(
                    'Hip-Hop' => "Hip-Hop",
                    'Electro' => "Electro",
                    'Rock' => "Rock",
                    'Disco' => "Disco",
                    'Générique' => "Générique",
                    'Soul' => "Soul",
                    'Pop' => "Pop",
                    'Funk' => "Funk",
                ),
                'label' => "Genre",
                'required'=> true))
            ->add('modifier', SubmitType::class,array('label'=>'Modifier'))
            ->getForm();


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $artiste = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Artiste modifié!');
            return $this->redirectToRoute('admin');
        }
        return $this->render('artistes/updateArtiste.html.twig',array('form' => $form->createView()) );

    }

    /**
     * @Route("/liste/artiste/delete/", name="show-artiste-delete")
     */
    public function listeDeleteArtiste()
    {
        $repository = $this->getDoctrine()->getRepository(Artistes::class);
        $liste=$repository->findAll();
        return $this->render('artistes/liste-artiste-delete.html.twig', array('artistes'=>$liste));

    }



    /**
     * @Route("/delete/artiste/{id}", name="artiste-delete", requirements={"id"="\d+"})
     */
    public function deleteArtiste(Artistes $artiste){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($artiste);
        $entityManager->flush();
        $this->addFlash('warning', 'Artiste supprimé!');
        return $this->redirectToRoute('admin');

    }


}
