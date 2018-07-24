<?php

namespace App\Controller;

use App\Form\ArticlesType;
use App\Service\FileUploader;
use App\Entity\Articles;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ArticlesController extends Controller
{
    /**
     * @Route("/articles", name="articles")
     */
    public function index()
    {
        return $this->render('articles/index.html.twig', [
            'controller_name' => 'ArticlesController',
        ]);
    }



    /**
     * @Route("/articles/", name="all-articles")
     */
    public function showAllArticles(){

        $repository = $this->getDoctrine()->getRepository(Articles::class);

        $articles = $repository->findAll();

        return $this->render('articles/articles.html.twig', array('articles'=>$articles));

    }


    /**
     * @Route("/article/{id}", name="detail-article", requirements={"id"="[0-9]+"})
     */
    public function detail($id){

        $repository = $this->getDoctrine()->getRepository(Articles::class);

        $article = $repository->find($id);

            if(!$article){
                throw $this->createNotFoundException('No article found for id' .$id);
            }

        return $this->render('articles/detailarticle.html.twig',  array('article'=>$article));

    }


    /**
     * @Route("/articles/ajout", name="add-article")
     */
    public function addArticle(Request $request, FileUploader $uploader)
    {
        //seul les users peuvent inserer un article
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $article = new Articles();

        //je place en parametre l'objet article a mon formulaire
        $form = $this->createForm(ArticlesType::class, $article);

        //je vais demander a mon objet form de gerer les donnees envoyées par l'utilisateur
        $form->handleRequest($request);

        //je vais faire le traitement d'ajout si le formulaire a etet envoyé et s'il est valide
        if($form->isSubmitted() && $form->isvalid()){

            //form->getData() contient les données envoyées
            //ici on charge le formulaire de remplir notre objet categorie avec les données
            $article = $form->getData();
            $article->setDatePubli(new \DateTime(date('Y-m-d H:i:s')));

            //ceci va contenir l'image envoyée
            $file = $article->getImage();

            $fileName = $uploader->upload($file);

            //on met a jour la propriété image, qui doit contenir le nom du fichier et pas le fichier lui meme
            //pour pouvoir persister l'article
            $article->setImage($fileName);

            //l'utilisateur connecté est l'auteur de l'article

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($article);
            $entityManager->flush();

            $this->addFlash('info', 'L\'article a bien été enregistré');

            return $this->redirectToRoute('all-articles');
        }

        return $this->render('articles/addarticle.html.twig', array('form' => $form->createView()));
    }




}
