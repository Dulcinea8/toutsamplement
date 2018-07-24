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
            ->add('username',TextType::class, array('label' => 'Username'))
            ->add('prenom', TextType::class, array('label' => 'Prenom'))
            ->add('nom', TextType::class, array('label' => 'Nom'))
            ->add('email',EmailType::class, array('label' => 'Email'))
            ->add('plainPassword', RepeatedType::class, array('type' => PasswordType::class, 'help' => 'le mot de passe doit être 6 caracteres et au moins une majuscules, une minuscule et un chiffre','invalid_message' => 'les mdp ne sont pas identiques', 'first_options' => ['label' => 'mot de passe'],
                'second_options' => ['label' => 'répétez le mot de passe'] ))
            ->add ('ajouter', SubmitType::class, array ('label'=> 'Valider', 'attr' => ['class'=> 'btn btn-primary']));
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
