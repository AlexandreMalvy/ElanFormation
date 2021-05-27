<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Formation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre', TextType::class, [])
            ->add('module',EntityType::class,[
                'class' => Module::class,
                'choice_label' => 'ModuleOption',
                'multiple' => true,
                'expanded' => true 
            ])
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
            'data_class' => Formation::class,
        ]);
    }
}
