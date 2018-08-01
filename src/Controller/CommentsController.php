<?php

namespace App\Controller;

use App\Entity\Comments;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CommentsController extends Controller
{
    /**
     * @Route("/comments", name="comments")
     */
    public function index()
    {
        return $this->render('comments/index.html.twig', [
            'controller_name' => 'CommentsController',
        ]);
    }

    /**
     * @Route("/remove/comments", name="remove-commentaire")
     */
    public function removeComments(Request $request)
    {
        $id = $request->request->get('supprimer');
        dump($id);
        $repository = $this->getDoctrine()->getRepository(Comments::class);
        $commentaire = $repository->find($id);
        $idArticle= $commentaire->getIdarticle()->getId();
        dump($idArticle);
        dump($commentaire);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($commentaire);
        $entityManager->flush();

        return $this->redirectToRoute('detail-article', array('id' => $idArticle));
    }
}
