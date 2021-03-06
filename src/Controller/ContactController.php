<?php

namespace App\Controller;


use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class ContactController extends Controller
{

    /**
     * @Route("/contact", name="contact")
     *
     */
    public function index(\Swift_Mailer $mailer)
    {
            $confirmMessage="";
            $errorMessage="";
        if(!empty($_POST)){

            $errors = [];


            if(empty($_POST['nom']) ){
                $errors[] = 'Veuillez rensegner votre nom';
            }
            if(empty($_POST['sujet'])){
                $errors[] = 'Veuillez rensegner un sujet';
            }

            //verifier l'email
            if(empty($_POST['email']) OR filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false){
                $errors[] = 'email erronné o manquante';
            }


            //verifier le message
            if(empty($_POST['message'])){
                $errors[] = 'Message manquante';
            }


            //vérifs terminées

            if(empty($errors)){

                $nom= $_POST['nom'];
                $sujet= $_POST['sujet'];
                $email= $_POST['email'];
                $message= $_POST['message'];

                $message = (new \Swift_Message('Contact tout samplement'))
                    ->setFrom($_POST['email'])
                    ->setTo('contact.toutsamplement@gmail.com')
                    ->setBody(
                        $this->renderView(
                        // templates/emails/registration.html.twig
                            'contact/mail.html.twig',
                            ['nom'=>$nom, 'sujet'=>$sujet, 'email'=>$email, 'message'=>$message]
                        ),
                        'text/html'

                    );

                if ($mailer->send($message)) {
                    $confirmMessage="L'email a bien été envoyé !";
                }else{
                    $errorMessage="Erreur lors de l'envoi de l'email veuillez verifier vos champs.";
                }


            }
            else {


                $errorMessage="Erreur lors de l'envoi de l'email veuillez verifier vos champs.";
            }



    
    	}



        return $this->render('contact/index.html.twig', [
            'success'=>$confirmMessage, 'error'=>$errorMessage,
        ]);
    }

}
