<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticlesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,  array('label' => 'Saisir le titre'))
            ->add('content', TextType::class,  array('label' => 'Saisir le contenu'))
            ->add('author', EntityType::class,
                //on va se baser sur l'entité user
                array('class' => Users::class,
                    //on choisi la propriété de l'entité a afficher dans la liste
                    'choice_label' => 'username'))
            ->add('image', FileType::class, array('label' => 'Ajouter une image', 'required' => true))
            ->add('ajouter', SubmitType::class, array('label' => 'Enregistrer', 'attr' => ['class' => 'btn btn-primary']));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
