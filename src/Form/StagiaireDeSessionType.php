<?php

namespace App\Form;

use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StagiaireDeSessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', TextType::class, [])
            ->add('prenom', TextType::class, [])
            ->add('email', EmailType::class, [])
            ->add('NumeroPoleEmploi', TextType::class, [])
            ->add('adresse', TextType::class, [])
            ->add('cp', NumberType::class, [])
            ->add('ville', TextType::class, [])
            ->add('telephone', NumberType::class, [])
            ->add('sessions', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'titre',
                'attr' => ["class" => "uk-select"]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
