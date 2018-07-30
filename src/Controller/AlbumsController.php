<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Service\FileUploader;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;

class AlbumsController extends Controller
{
    /**
     * @Route("/albums", name="albums")
     */
    public function index()
    {
        return $this->render('albums/index.html.twig', [
            'controller_name' => 'AlbumsController',
        ]);
    }

    /**
     * @Route("/liste/albums/", name="liste-albums")
     */
    public function listeAlbums()
    {
        $repository = $this->getDoctrine()->getRepository(Albums::class);

        $liste=$repository->findAll();
        return $this->render('albums/listeAlbums.html.twig', array('albums'=>$liste));

    }

    /**
     * @Route("/update/album/{id}", name="album-update", requirements={"id"="\d+"})
     */
    public function updateAlbum(Albums $album, Request $request, FileUploader $uploader)
    {
        $years = [];
        for($i=1900; $i<=date('Y'); $i++){
            $years[$i]=$i;
        }
        $fileName = $album->getPochette();
        //pour pouvoir generer le formulaire, on doit transformer le nom du ficier stocké pour l'instant dans l'attribut pochette en instance de la classe File, (ce qui est attendu par le formulaire)
        $album->setPochette(new File($this->getParameter('articles_image_directory') . '/' . $album->getPochette()));
        $file = $album->getPochette();
        dump($fileName);
        $form = $this->createFormBuilder($album)
            ->add('nom', TextType::class,array('label'=>'Nom', 'required'=>true))
            ->add('annee', ChoiceType::class,array('label'=>'Année', 'choices' => $years, 'required'=>true))
            ->add('pochette',FileType::class, array('label' => 'Pochette', 'required' => true))
            ->add('modifier', SubmitType::class,array('label'=>'Modifier'))
            ->getForm();


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $album = $form->getData();

            ///je fait le traitemnet si on m'a envoy&é une image
            if ($album->getPochette()) {
                //je stocke dans cette variable le nom du fichier actuel qui doit être supprimé ou null s'il n'y en a pas
                $oldFileName = $album->getPochette() ? $album->getPochette() : null;
                //on recupere un objet de classe file
                $file = $album->getPochette();
                //dump($file);
                $fileName = $uploader->upload($file, $oldFileName);

            }
            $album->setPochette($fileName);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->flush();
            $this->addFlash('success', 'Album modifié!');
            return $this->redirectToRoute('admin');
        }
        return $this->render('albums/updateAlbum.html.twig',array('form' => $form->createView(), 'pochette' => $fileName) );

    }

}
