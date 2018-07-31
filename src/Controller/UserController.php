<?php

namespace App\Controller;

use App\Entity\Relations;
use App\Entity\Users;
use App\Form\UserFormType;
use App\Form\UserUpdateType;
use Symfony\Component\ExpressionLanguage\Token;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
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
        $id = $user->getId();
        $repositorySamples = $this->getDoctrine()->getRepository(Relations::class);
        $samples = $repositorySamples->findByUser($id);



        return $this->render('user/profil.html.twig', array('user' => $user, 'samples' => $samples)  );
    }


    /**
     * @Route("/profil/{id}", name="profilUser", requirements={"id"="[0-9]+"})
     */
    public function detailProfil(Users $user){

        return $this->render('user/profilUser.html.twig',  array('user'=>$user));

    }

    /**
     * @route("profil/delete/{id}", name="supprimer-profil", requirements={"id"="\d+"})
     */
    public function deleteProfil(Users $user){

        $this->denyAccessUnlessGranted('DELETE', $user);

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

        return $this->redirectToRoute('logout');

    }

    /**
     * @Route("/updateProfil/{id}", name="update_profil" , requirements={"id"="\d+"})
     */
    public function updateProfil(Users $user, Request $request,FileUploader $uploader){

            $this->denyAccessUnlessGranted('EDIT', $user);

            $fileName = $user->getAvatar();

            if ($user->getAvatar()) {
                //pour pouvoir generer le formulaire, on doit transformer le nom du ficier stocké pour l'instant dans l'attribut image en instance de la classe File, (ce qui est attendu par le formulaire)
                $user->setAvatar(new File($this->getParameter('articles_image_directory') . '/' . $user->getAvatar()));
            }

            $form = $this->createForm(UserUpdateType::class, $user);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $user = $form->getData();

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
                $entityManager = $this->getDoctrine()->getManager();
                //$entityManager->persist($user);
                $entityManager->flush();
                $this->addFlash('success', 'Modification fait');
                return $this->redirectToRoute('profil');
            }
            return $this->render('user/updateProfil.html.twig', array('form' => $form->createView(), 'avatar' => $fileName));

    }

}
