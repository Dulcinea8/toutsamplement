<?php

namespace App\Controller;

use App\Form\ArticlesType;
use App\Service\FileUploader;
use App\Entity\Articles;
use Symfony\Component\HttpFoundation\File\File;
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


    /**
     * @route("/article/update/{id}", name="modifier-article", requirements={"id"="\d+"})
     *
     */

    public function updateArticle(Articles $article, Request $request, FileUploader $uploader){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        //je stocke le nom du fichier
        $fileName = $article->getImage();

        if($article->getImage()) {

            //pour pouvoir generer le formulaire, on doit transformer le nom du fichier stocké pour l'instant dans l'attribut
            //image en instance de la classe File (ce qui est attendu par le formulaire)

            $article->setImage(new File($this->getParameter('articles_image_directory') . '/' . $article->getImage()));

        }

        $form = $this->createForm(ArticlesType::class, $article);

        $form->handleRequest($request);

        //je vais faire le traitement d'ajout si le formulaire a etet envoyé et s'il est valide
        if($form->isSubmitted() && $form->isvalid()){

            //form->getData() contient les données envoyées
            //ici on charge le formulaire de remplir notre objet categorie avec les données
            $article = $form->getData();

            //je ne fais le traitement d'upload que si on m'a envoyé un fichier
            if($article->getImage()) {

                //on recupere un objet de classe file
                $file = $article->getImage();

                //on genere un nouveau nom
                $fileName = $uploader->upload($file, $fileName);
            }


            //jon met à jour la propriété image qui doit contenir le nom du fichier pour etre persistée
            // fileName contient soit le nouveau nom de fichier si on a recu une nouvelle image,
            // soit l'ancien si l'utilisateur n'a pas modifié l'image
            $article->setImage($fileName);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            $this->addFlash('info', 'L\'article a bien été modifié');

            return $this->redirectToRoute('all-articles');
        }

        return $this->render('articles/updatearticle.html.twig', array('form' => $form->createView()));

    }

    /**
     * @route("article/delete/{id}", name="supprimer-article", requirements={"id"="\d+"})
     */
    public function deleteArticle(Articles $article){

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        //recuperation de l'entite manager
        $entityManager = $this->getDoctrine()->getManager();

        //je veux supprimer cette catégorie
        $entityManager->remove($article);

        //j'execute la requete
        $entityManager->flush();

        $this->addFlash('danger', 'L\'article a bien été supprimé');

        return $this->redirectToRoute('all-articles');

    }



}
