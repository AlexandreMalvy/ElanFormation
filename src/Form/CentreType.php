<?php

namespace App\Form;

use App\Entity\Centre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CentreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ville', TextType::class, [])
            ->add('adresse', TextType::class, [])
            ->add('cp', TextType::class, [])
            ->add('Valider', SubmitType::class, [
                'attr' => [
                    "class" => "uk-button uk-button-primary uk-button-large",
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Centre::class,
        ]);
    }
}
