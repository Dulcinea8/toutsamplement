<?php

namespace App\Controller;

use App\Entity\ResetPass;
use App\Entity\Users;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
    {
        //recuperation d'eventuelles erreurs de login
        $error = $authenticationUtils->getLastAuthenticationError();
        //récupération du nom d'utilisateur  (pour pré remplir le champ login en cas d'erreur)
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' =>$lastUsername,
            'error'  => $error
        ]);
    }

    /**
     * @Route("/cgu", name="cgu")
     */
    public function cgu()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/reset-password", name="reset-password")
     */
    public function resetPassword(Request $request,\Swift_Mailer $mailer)
    {

        $email = $request->request->get('email', 0);

        if($email){
            //verifier que l'email existe dans ma bdd

            $repository=$this->getDoctrine()->getRepository(Users::class);
            $user=$repository->searcheEmail($email);
            //dump($user);
            if($user){
                //l'email existe
                $resetPass = new ResetPass();

                $token = md5(uniqid(rand(),true));

                //je rentre dans la bdd mon token et le user_id
                $resetPass->setToken($token);
                $resetPass->setUser($user['0']);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($resetPass);
                $entityManager->flush();

                $id_user = $user['0']->getId(); // avec getId je recupere l'element
                dump($id_user);
                $message = (new \Swift_Message('Reset Mot de Passe'))
                    ->setFrom('contact.toutsamplement@gmail.com')
                    ->setTo($email)
                    ->setBody(
                        $this->renderView(
                        // templates/emails/registration.html.twig
                            'security/resetPassword.html.twig',
                            array('token' => $token, 'idUser' => $id_user)
                        ),
                        'text/html'
                    );

                if ($mailer->send($message)) {
                    $this->addFlash('success', "L'email a bien été envoyé !");
                }else{
                    $this->addFlash('danger',"Erreur lors de l'envoi de l'email veuillez verifier votre adresse email.");
                }
            }else{
                $this->addFlash('danger',"Ton email n'existe pas dons notre base de données.");
            }
        }


        return $this->render('user/requestEmail.html.twig');
    }

    /**
     * @Route("/new-password", name="new-password")
     */
    public function newPassword(Request $request)
    {
        $token = $request->query->get('token', 0);
        $id_user = $request->query->get('iduser', 0);
        if($token && $id_user){
            //verifier que le token et le user id existe dans ma bdd
            $repository=$this->getDoctrine()->getRepository(ResetPass::class);
            $resetPassword=$repository->searcheToken($token,$id_user);
            if(!$resetPassword){
                //token et id incorrects donc redirectionner
                $this->addFlash('danger',"Error!! parametres invalides");
                return $this->redirectToRoute('reset-password');
            }
        }else{
            $this->addFlash('error',"ERROR!!");
        }
        return $this->render('security/newPassword.html.twig', array('idUser'=>$id_user) );
    }

    /**
     * @Route("/ResetPasswordOk", name="reset-password-ok")
     */
    public function modifPassword(Request $request, UserPasswordEncoderInterface $encoder)
    {
        //ici je vais faire la modification de mot de passe
        $password = $request->request->get('password', 0);
        //metre en cript le mdp

        $idUser = $request->request->get('idUser');
        $user = $this->getDoctrine()->getRepository(Users::class )->find($idUser);
        if($user){
            $mdpEncoded = $encoder->encodePassword($user, $password);
        }

        if($password){
            $repository=$this->getDoctrine()->getRepository(Users::class);
            $user=$repository->find($idUser);

            if($user){
                $user->setpassword($mdpEncoded);
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', "Mot de passe modifié !");
            }else{
                $this->addFlash('danger',"Le mot de passe n'a pa pu être modifié");
            }
        }
        return $this->render('security/motDePasseModifie.html.twig');
    }
}
