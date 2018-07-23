<?php

namespace App\Controller;

use App\Entity\Articles;
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
     * @Route("/article/", name="detail-article", requirements={"id"="[0-9]+"})
     */
    public function detail($id){

        $repository = $this->getDoctrine()->getRepository(Articles::class);

        $article = $repository->find($id);

            if(!$article){
                throw $this->createNotFoundException('No article found for id' .$id);
            }

        return $this->render('article/detail.html.twig',  array('article'=>$article));

    }







}
