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
            // Sélection de l'ingrédient pour la DataSheet
            ->add('ingredient', EntityType::class, [
                'class' => Ingredient::class,
                'choice_label' => 'name',  // Affiche le nom de l'ingrédient
                'label' => 'Ingrédient',
                'placeholder' => 'Recherchez un ingrédient',
                'required' => true,
            ])
            // Spécification du poids de l'ingrédient
            ->add('weight', NumberType::class, [
                'label' => 'Poids',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Entrez le poids (ex: 100)',
                ],
            ])
            // Choix de l'unité pour le poids de l'ingrédient
            ->add('unit', EntityType::class, [
                'class' => Unit::class,
                'choice_label' => 'name',  // Affiche le nom de l'unité
                'label' => 'Unité',
                'placeholder' => 'Sélectionnez une unité',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Assure-toi de travailler avec la bonne classe de données ici
        $resolver->setDefaults([
            'data_class' => Ingredient::class,  // Si tu modifies un ingrédient directement
        ]);
    }
}
