<?php

namespace App\Controller;


use App\Form\ContactType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    /**
     * @Route("/contact", name="contact")
     */
    public function index()
    {
    	 

        $form = $this->createForm(ContactType::class);

       
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView()
        ]);
    }

}
