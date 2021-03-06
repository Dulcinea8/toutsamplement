<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, array('label' => 'Nom*','required'=>true))
            ->add('sujet', TextType::class, array('label' => 'Sujet*','required'=>true))
            ->add('email', EmailType::class,  array('label' => 'Email*','required'=>true))
            ->add('message', TextareaType::class, array('label' => 'Message*','required'=>true))
            ->add('Envoyer', SubmitType::class, array ('label'=> 'Envoyer', 'attr' => ['class'=> 'btn btn-warning']))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
