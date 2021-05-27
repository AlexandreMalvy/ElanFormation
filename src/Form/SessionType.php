<?php

namespace App\Form;

use App\Entity\Centre;
use App\Entity\Session;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, ['attr' => [
                "class" => "uk-input"
            ]])
            ->add('dateDebut', DateType::class, [
                'attr' => [
                    "class" => "uk-input"
                ],
                "widget" => "single_text"
            ])
            ->add('dateFin', DateType::class, [
                'attr' => [
                    "class" => "uk-input"
                ],
                "widget" => "single_text"
            ])
            ->add('type', TextType::class, ['attr' => [
                "class" => "uk-input"
            ]])
            ->add('nbrMax', IntegerType::class, ['attr' => [
                "class" => "uk-input"
            ]])
            ->add('nbrMin', IntegerType::class, ['attr' => [
                "class" => "uk-input"
            ]])
            ->add('formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'titre',
                'attr' => ["class" => "uk-select"]
            ])
            ->add('centre', EntityType::class, [
                'class' => Centre::class,
                'choice_label' => 'adresse',
                'attr' => ["class" => "uk-select"]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Session::class,
        ]);
    }
}
