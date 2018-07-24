<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class UserController extends Controller
{
    /**
     * @Route("/user", name="user")
     */
    public function index()
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    /**
     * @Route("/register/", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder){
        $user = new Users();
        $form= $this->createForm(UserFormType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted()&& $form->isValid()){
            //on recupère les données envoyées via le formulaire
            $user = $form->getData();
            $user->setDateInscription(new \DateTime(date('Y-m-d H:i:s')));
            $user->setScore(0);
            //je définis un role par défaut
            $user->setRole(array('ROLE_USER'));

            // à ce moment, $user->getPassword() vaut null, seul $plainPassword contient le mdp en clair
            //je dois encoder le mdp en clair  (plainpassword) et le mettre dans password
            //c'est moi qui fixe le role
            $mdpEncoded = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($mdpEncoded);
            //pour effacer le mdp en claire
            $user->eraseCredentials();




            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Vous êtes bien inscrit, Vous pouvez vous connecter');

            //renvoi sur le login
            return $this->redirectToRoute('login');
        }

        return $this->render('user/register.html.twig', array('form' => $form->createView()) );
    }





}
