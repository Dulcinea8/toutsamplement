<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserFormType;
use App\Form\UserUpdateType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\File\File;


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
            $user->setRoles(array('ROLE_USER'));

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

    /**
     * @Route("/profil", name="profil")
     */
    public function profil(Request $request){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        return $this->render('user/profil.html.twig', array('user' => $user)  );
    }


    /**
     * @Route("/updateProfil/{id}", name="update_profil" , requirements={"id"="\d+"})
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
            return $this->redirectToRoute('profil');
        }
        return $this->render('user/updateProfil.html.twig', array('form' => $form->createView(),'avatar' => $fileName)  );
    }

    /**
     * @Route("/deleteProfil/{id}", name="delete_profil" , requirements={"id"="\d+"})
     */
   /* public function deleteProfil(Users $user)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();
        //supprimer l'image si elle existe
        //si on m'a fourni un nom de fichier et que ce nom existe bien
        if($user->getAvatar() and file_exists('%kernel.project_dir%/public/uploads/images/' . $user->getAvatar())){
            //je supprime le fichier
            unlink('%kernel.project_dir%/public/uploads/images/'  . $oldFileName);
        }



        $this->addFlash('warning', 'Profil modifié');
        return $this->redirectToRoute('\logout');
    }*/



}
