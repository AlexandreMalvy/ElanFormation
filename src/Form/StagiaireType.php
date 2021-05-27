<?php

namespace App\Form;

use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StagiaireType extends AbstractType
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
            ->add('Valider', SubmitType::class, [])
            ->add('formation', EntityType::class, [
                            'class' => Formation::class,
                            'choice_label' => 'titre',
                            'attr' => ["class" => "uk-select"]
                        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
