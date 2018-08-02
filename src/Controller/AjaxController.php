<?php

namespace App\Controller;

use App\Entity\Albums;
use App\Entity\Articles;
use App\Entity\Likes;
use App\Entity\Artistes;
use App\Entity\Comments;
use App\Entity\Relations;
use App\Entity\Tracks;
use App\Entity\Users;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AjaxController extends Controller
{
    /**
     * @Route("/ajax/search", name="ajax-search" )
     */
    public function searchByTrackArtist(Request $request)
    {

        //$get = $request->query->all();
        $recherche=$request->query->get('recherche', null);
        //dump($recherche);

        $repository = $this->getDoctrine()->getRepository(Tracks::class);
        $tracks = $repository->searchTrack($recherche);


        $repository = $this->getDoctrine()->getRepository(Artistes::class);
        $artistes = $repository->searchArtist($recherche);

        //dump($artistes);
        //dump($artistes);
        return $this->render('ajax/search.html.twig', [
            'tracks' => $tracks, 'artistes' => $artistes
        ]);
    }

    /**
     * @Route("/ajax/search-by-genre/{genre}", name="ajax-search-by-genre", options={"utf8":true}, requirements={"genre"="[-A-záàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]+"})
     */
    public function searchByGenre($genre)
    {
        //j'ai recupere l'artiste grace a mon parametre {genre}
        $repository = $this->getDoctrine()->getRepository(Relations::class);
        //on rajoute a la suite de findBy le nom de la propriété par laquelle on fait la recherche
        //doctrine va comprendre et faire la requete appropriée
        $samples = $repository->myfindSamplesGenre($genre);

        return $this->render('ajax/genre.html.twig', [
            'samples' => $samples,
        ]);
    }

    /**
     * @Route("/ajax/commentaire", name="laisser-commentaire")
     */
    public function comment(Request $request)
    {
        $contenu = $request->request->get('contenu');
        $idArticle = $request->request->get('idArticle');
        $repository = $this->getDoctrine()->getRepository(Articles::class);
        $article = $repository->find($idArticle);
        //dump($idArticle);

        $entityManager = $this->getDoctrine()->getManager();
        $commentaire = new Comments();
        $commentaire->setMessage($contenu);
        //$id_user = $this->getUser()->getId();
        $commentaire->setIduser($this->getUser());
        $commentaire->setIdArticle($article);
        //l'attibut date_publi est de type datetime et doit contenir un objet de classe DateTime
        $date_publi = new \DateTime(date('Y-m-d H:i:s'));
        $commentaire->setDatePubli($date_publi);
        $entityManager->persist($commentaire);
        //flush permet d'executer la requete d'insertion, on peut la faire une fois après plusieurs persist
        $entityManager->flush();


        dump($commentaire);

        return $this->render('ajax/laisserCommentaire.html.twig', [
            'commentaire' => $commentaire,
        ]);
    }

    /**
    *@Route("/likes", name="likes")
    */
    public function likes(Request $request)
    {
        $user = $request->request->get('user');
        $article = $request->request->get('article');
        $repository = $this->getDoctrine()->getRepository(Likes::class);
        $repositoryA = $this->getDoctrine()->getRepository(Articles::class);
        $repositoryU = $this->getDoctrine()->getRepository(Users::class);
        $repositoryC = $this->getDoctrine()->getRepository(Comments::class);
        $entityManager = $this->getDoctrine()->getManager();
        $articleObject = $repositoryA->findOneById($article);
        if ($repository->findLikes($user, $article) !=null) {
            $like= $repository->findLikes($user, $article);
            $like2= $like['id'];
            $like3 = $repository->findOneById($like2);  
            $entityManager->remove($like3);
            $entityManager->flush();

        $likes= $repository->findLikesOnArticle($article);
        $compte= $repository->compteLikes($article);

        }else{
            $userObject = $repositoryU->findOneById($user);
            
            $like = new likes();
            $like->addUser($userObject);
            $like->addArticle($articleObject);

            $entityManager->persist($like);
            $entityManager->flush();

        $likes= $repository->findLikesOnArticle($article);
        $compte= $repository->compteLikes($article);

        }

        $commentaires = $repositoryC->findByIdarticle($article);

        return $this->render('articles/detailarticle.html.twig',  [
            'article' => $articleObject,'commentaires' => $commentaires,
            'likes' => $likes,
            'compte' => $compte['COUNT(*)'],

        ]);
    }
}
