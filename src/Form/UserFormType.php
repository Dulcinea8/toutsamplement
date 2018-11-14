<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username',TextType::class, array('label' => 'Username*','required'=>true))
            ->add('prenom', TextType::class, array('label' => 'Prenom','required'=>false))
            ->add('nom', TextType::class, array('label' => 'Nom','required'=>false))
            ->add('email',EmailType::class, array('label' => 'Email*','required'=>true))
            ->add('plainPassword', RepeatedType::class, array('type' => PasswordType::class, 'help' => 'le mot de passe doit être 6 caracteres et au moins une majuscules, une minuscule et un chiffre','invalid_message' => 'les mdp ne sont pas identiques', 'first_options' => ['label' => 'Mot de passe*'],
                'second_options' => ['label' => 'Répétez le mot de passe*'] ,'required'=>true))
            ->add ('ajouter', SubmitType::class, array ('label'=> 'Valider', 'attr' => ['class'=> 'btn btn-warning']));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
