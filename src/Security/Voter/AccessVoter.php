<?php

namespace App\Security\Voter;


use App\Entity\Articles;
use App\Entity\Users;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class AccessVoter extends Voter
{
    const VIEW = 'VIEW';
    const EDIT = 'EDIT';
    const DELETE = 'DELETE';

    protected function supports($attribute, $subject)
    {
        //si l'attribut n'est pas supporté, on renvoie false
        if(!in_array($attribute, array(self::VIEW, self::EDIT, self::DELETE))){
            return false;
        }

        //si $subject n'est pas supporté, on renvoie false
        if(!$subject instanceof Articles){
            return false;
        }
        return true;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        //je recupere l'utilisateur connecté
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        //grace a la methode support on sait que $subject (passé en parametre est un objet de class article

        $article = $subject;

        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($article, $user);
                break;
            case self::VIEW:
                return $this->canView($article, $user);
                break;
            case self::DELETE:
                return $this->canDelete($article, $user);
                break;
        }

        return false;
    }

    //je crée une methode qui va determiner si l'utilisateur peut modifier l'article
    private function canEdit(Articles $article, Users $user){
        //l'utilisateur peut modifier l'article s'il en est l'auteur
        if($user == $article->getUser()){
            return true;
        }
        else{
            return false;
        }
    }

    //je vais créer la methode qui va determiner si l'utilisateur peut voir l'artcile
    private function canView(Articles $article, Users $user){
        return true;
    }

    //je vais créer la methode qui va determiner si l'utilisateur peut effacer l'artcile
    private function canDelete(Articles $article, Users $user){
        //l'utilisateur peut modifier l'article s'il en est l'auteur
        if($user == $article->getUser()){
            return true;
        }
        else{
            return false;
        }
    }
}
