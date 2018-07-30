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
        if(!$subject instanceof Users){
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

        //grace a la methode support on sait que $subject (passé en parametre est un objet de class user


        switch ($attribute) {
            case self::EDIT:
                return $this->canEdit($user, $subject);
                break;
            case self::VIEW:
                return $this->canView($user);
                break;
            case self::DELETE:
                return $this->canDelete($user, $subject);
                break;
        }

        return false;
    }

    //je crée une methode qui va determiner si l'utilisateur peut modifier
    private function canEdit(Users $user, Users $subject){
        //l'utilisateur peut modifier son profil
        if($user === $subject){
            return true;
        }
        else{
            return false;
        }
    }

    //je vais créer la methode qui va determiner si l'utilisateur peut voir
    private function canView(Users $user){
        return true;
    }

    //je vais créer la methode qui va determiner si l'utilisateur peut effacer
    private function canDelete(Users $user, Users $subject){
        //l'utilisateur peut supprimer
        if($user == $subject){
            return true;
        }
        else{
            return false;
        }
    }
}
