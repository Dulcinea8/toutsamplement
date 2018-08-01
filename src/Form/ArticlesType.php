<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class,  array('label' => 'Votre titre'))
            ->add('content', TextareaType::class,  array('label' => 'Saisir le contenu'))
            ->add('auteur_id', EntityType::class,
                //on va se baser sur l'entité user
                array('class' => Users::class,
                    //on choisi la propriété de l'entité a afficher dans la liste
                    'choice_label' => 'username'))
            ->add('image', FileType::class, array('label' => 'Ajouter une image', 'required' => false))
            ->add('video', UrlType::class, array('label' => 'Lien :', 'required' => false))
            ->add('ajouter', SubmitType::class, array('label' => 'Enregistrer', 'attr' => ['class' => 'btn btn-warning']));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
