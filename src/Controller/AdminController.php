<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Artistes;
use App\Entity\Users;
use App\Form\ArticlesType;
use App\Form\UserUpdateType;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("/admin/profil/{id}", name="admin-profil", requirements={"id"="[0-9]+"})
     */
    public function detailProfil(Users $user){

        return $this->render('admin/profil.html.twig',  array('user'=>$user));

    }

    /**
     * @Route("admin/update/profil/{id}", name="admin-modifier-profil" , requirements={"id"="\d+"})
     */
    public function updateProfil(Users $user, Request $request,FileUploader $uploader){
        $fileName = $user->getAvatar();
        if($user->getAvatar()) {
            //pour pouvoir generer le formulaire, on doit transformer le nom du ficier stocké pour l'instant dans l'attribut image en instance de la classe File, (ce qui est attendu par le formulaire)
            $user->setAvatar(new File($this->getParameter('articles_image_directory') . '/' . $user->getAvatar()));
        }
        $form = $this->createForm(UserUpdateType::class, $user);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid())
        {
            $user=$form->getData();

            ///je fais le traitement si on m'a envoy&é une image
            if ($user->getAvatar()) {
                //je stocke dans cette variable le nom du fichier actuel qui doit être supprimé ou null s'il n'y en a pas
                $oldFileName = $user->getAvatar() ? $user->getAvatar() : null;
                //on recupere un objet de classe file
                $file = $user->getAvatar();
                //dump($file);
                $fileName = $uploader->upload($file, $oldFileName);

            }
            $user->setAvatar($fileName);
            $entityManager=$this->getDoctrine()->getManager();
            //$entityManager->persist($user);
            $entityManager->flush();
            $this->addFlash('success', 'Modification fait');
            return $this->redirectToRoute('admin-profil');
        }
        return $this->render('admin/updateProfil.html.twig', array('form' => $form->createView(),'avatar' => $fileName)  );
    }

    /**
     * @route("admin/article/delete/{id}", name="admin-supprimer-profil", requirements={"id"="\d+"})
     */
    public function deleteProfil(Users $user){


        //recuperation de l'entite manager
        $entityManager = $this->getDoctrine()->getManager();

        //je veux supprimer cette catégorie
        $entityManager->remove($user);

        //j'execute la requete
        $entityManager->flush();

        $this->addFlash('danger', 'Le profil a bien été supprimé');

        return $this->redirectToRoute('admin');

    }

    /**
    * @Route("/admin/requete_insertion", name="requete-insertion")
    */
    public function requete(){
    	$repositoryRelations = $this->getDoctrine()->getRepository(Relations::class);
    	$repositoryAlbums = $this->getDoctrine()->getRepository(Albums::class);
        $requetes = $repositoryRelations->getNonValidated();
   
    	return $this->render('admin/requete_insertion.html.twig', ['requetes'=>$requetes]);
    }

    /**
     * @Route("/admin/", name="admin-accueil")
     */
    public function accueil()
    {

        $repositoryArtistes = $this->getDoctrine()->getRepository(Artistes::class);
        $artistes = $repositoryArtistes->last4Artistes();

        $repositoryArticles = $this->getDoctrine()->getRepository(Articles::class);
        $articles = $repositoryArticles->last4Articles();

        $repositorySamples = $this->getDoctrine()->getRepository(Relations::class);
        $samples = $repositorySamples->last4Samples();

        // $repositoryTracks = $this->getDoctrine()->getRepository(Tracks::class);
        // $tracks = $repositoryTracks->findTrackById($samples);


        return $this->render('admin/index.html.twig', array(
            'artistes'=>$artistes,
            'articles'=>$articles,
            'samples'=>$samples));
    }

    /**
     * @Route("/admin/articles/", name="admin-all-articles")
     */
    public function showAllArticles(){

        $repository = $this->getDoctrine()->getRepository(Articles::class);

        $articles = $repository->findAll();

        return $this->render('admin/articles.html.twig', array('articles'=>$articles));

    }


    /**
     * @Route("admin/article/{id}", name="admin-detail-article", requirements={"id"="[0-9]+"})
     */
    public function detailArticle($id){

        $repository = $this->getDoctrine()->getRepository(Articles::class);

        $article = $repository->find($id);

        if(!$article){
            throw $this->createNotFoundException('No article found for id' .$id);
        }

        return $this->render('admin/detailarticle.html.twig',  array('article'=>$article));

    }

    /**
     * @Route("/admin/articles/ajout", name="admin-add-article")
     */
    public function addArticle(Request $request, FileUploader $uploader, Articles $article)
    {
        //seul les users peuvent inserer un article

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

        return $this->render('admin/addarticle.html.twig', array('form' => $form->createView()));
    }


    /**
     * @route("/admin/article/update/{id}", name="admin-modifier-article", requirements={"id"="\d+"})
     *
     */

    public function updateArticle(Articles $article, Request $request, FileUploader $uploader){

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


            //on met à jour la propriété image qui doit contenir le nom du fichier pour etre persistée
            // fileName contient soit le nouveau nom de fichier si on a recu une nouvelle image,
            // soit l'ancien si l'utilisateur n'a pas modifié l'image
            $article->setImage($fileName);

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            $this->addFlash('info', 'L\'article a bien été modifié');

            return $this->redirectToRoute('all-articles');
        }

        return $this->render('admin/updatearticle.html.twig', array('form' => $form->createView()));

    }

    /**
     * @route("admin/article/delete/{id}", name="admin-supprimer-article", requirements={"id"="\d+"})
     */
    public function deleteArticle(Articles $article){


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
