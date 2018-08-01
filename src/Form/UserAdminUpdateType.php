<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class UserAdminUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $roles = ['admin'=>'ROLE_ADMIN','user' =>'ROLE_USER'];
        $builder
            ->add('username',TextType::class, array('label' => 'Username','required'=>true))
            ->add('nom',TextType::class, array('label' => 'Nom','required'=>true))
            ->add('prenom',TextType::class, array('label' => 'Prenom','required'=>true))
            ->add('email',EmailType::class, array('label' => 'Email','required'=>true))
            ->add('avatar',  FileType::class, array('label' => 'Ajouter ou Modifier l\'Avatar','required' => false))
            ->add('facebook',TextType::class, array('label' => 'Ton profil Facebook','required' => false))
            ->add('soundcloud', TextType::class, array('label' => 'Ton Soundcloud','required' => false))
            ->add('bandcamp', TextType::class, array('label' =>'Ton bandcamp','required' => false))
            ->add('site_web',TextType::class, array('label' => 'Ton Site Web','required' => false))
            ->add('bio', TextareaType::class, array('label' => 'Ta Biographie','required' => false))
            ->add('score',NumberType::class, array('label' => 'Ton Score','required' => false))
            ->add('roles', ChoiceType::class,array('label'=>'Role', 'multiple' => true, 'choices' => $roles, 'required'=>true))
            ->add ('ajouter', SubmitType::class, array ('label'=> 'Modifier', 'attr' => ['class'=> 'btn btn-warning']));
        ;



    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
