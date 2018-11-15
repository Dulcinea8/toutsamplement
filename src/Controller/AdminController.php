<?php

namespace App\Controller;

use App\Entity\Articles;
use App\Entity\Artistes;
use App\Entity\Users;
use App\Form\ArticlesType;
use App\Form\UserAdminUpdateType;
use App\Form\UserUpdateType;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Form;

use App\Entity\Relations;
use App\Entity\Albums;

class AdminController extends Controller
{
    /**
     * @Route("/admin/", name="admin")
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
     * @Route("/admin/profil/{id}", name="admin-profilUser", requirements={"id"="[0-9]+"})
     */
    public function detailProfil(Users $user){

        $id = $user->getId();
        $repositorySamples = $this->getDoctrine()->getRepository(Relations::class);
        $samples = $repositorySamples->findByUser($id);

        return $this->render('admin/profilUser.html.twig',  array('user'=>$user, 'samples' => $samples));

    }

    /**
     * @Route("/admin/all-profil/", name="admin-all-profil")
     */
    public function showAllProfil(){

        $repository = $this->getDoctrine()->getRepository(Users::class);

        $users = $repository->findAll();

        return $this->render('admin/users.html.twig',  array('users'=>$users));

    }


    /**
     * @Route("/admin/updateProfil/{id}", name="admin-update-profil" , requirements={"id"="\d+"})
     */
    public function updateProfil(Users $user, Request $request,FileUploader $uploader){

        $fileName = $user->getAvatar();

        if($user->getAvatar()) {
            //pour pouvoir generer le formulaire, on doit transformer le nom du ficier stocké pour l'instant dans l'attribut image en instance de la classe File, (ce qui est attendu par le formulaire)
            $user->setAvatar(new File($this->getParameter('articles_image_directory') . '/' . $user->getAvatar())); 
        }

        $form = $this->createForm(UserAdminUpdateType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted()&& $form->isValid())
        {
            $user=$form->getData();

            ///je fait le traitemnet si on m'a envoy&é une image
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
            return $this->redirectToRoute('admin');
        }
        return $this->render('admin/updateProfil.html.twig', array('form' => $form->createView(),'avatar' => $fileName)  );
    }


    /**
     * @route("admin/profil/delete/{id}", name="admin-supprimer-profil", requirements={"id"="\d+"})
     */
    public function deleteProfil(Users $user){

        //code pour s'eliminir soit meme
        $id= $user->getId();
        $currentUserId = $this->getUser()->getId();
        if ($currentUserId == $id)
        {
            $session = $this->get('session');
            $session = new Session();
            $session->invalidate();
        }

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
    public function requete(Request $request){
    	$entityManager = $this->getDoctrine()->getManager();
    	$repositoryRelations = $this->getDoctrine()->getRepository(Relations::class);
    	$repositoryAlbums = $this->getDoctrine()->getRepository(Albums::class);
        
        $msg="";


    	if($request->get('valider')) {

    	    //on aumente le score d'un 1
            $repositoryUsers = $this->getDoctrine()->getRepository(Users::class);
            $id = $request->request->get('idUser');
            dump($id);
            $user = $repositoryUsers->findOneById($id);
            dump($user);
            $ancienScore = $user->getScore();
            $nouveauScore = $ancienScore + 1;
            $user->setScore($nouveauScore);


        	$relationAValider= $repositoryRelations->findOneById($request->request->get('valider'));
        	$relationAValider->setIsValidated(true);
        	$entityManager->persist($relationAValider);
        	$entityManager->flush();
        	$msg="La relation a bien été validée";

        }elseif($request->get('refuser')){
        	$test='no id= '.$request->get('refuser');
        	$relationASuppr = $repositoryRelations->findOneById($request->get('refuser'));
        	$entityManager->remove($relationASuppr);
        	$entityManager->flush();
        	$msg="La relation a bien été supprimée";

        }

        $requetes = $repositoryRelations->getNonValidated();

   
    	return $this->render('admin/requete_insertion.html.twig', ['requetes'=>$requetes, 'msg'=>$msg]);
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
     * @Route("/admin/artistes/", name="admin-all-artistes")
     */
    public function showAllArtistes(){

        $repository = $this->getDoctrine()->getRepository(Users::class);

        $artistes = $repository->findAll();

        return $this->render('admin/articles.html.twig', array('articles'=>$artistes));

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





}
