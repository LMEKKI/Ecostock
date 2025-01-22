<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Unit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ingredient', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'ingredient',
                'label' => 'Ingrédient',
                'placeholder' => 'Recherchez un ingrédient',
            ])
            ->add('weight', NumberType::class, [
                'label' => 'Poids',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez le poids (ex: 100)',
                ],
            ])
            ->add('unit', EntityType::class, [
                'class' => Unit::class,
                'choice_label' => 'name',
                'label' => 'Unité',
                'placeholder' => 'Sélectionnez une unité',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null, // Par défaut, on n'associe pas ce formulaire à une entité spécifique
        ]);
    }
} 
