<?php

namespace App\Form;

use App\Entity\Ingredient;
use App\Entity\Unit;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IngredientType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      // Sélection de l'ingrédient pour la DataSheet
      ->add('name', TextType::class, [
        'label' => 'Nom de l\'ingrédient',
        'required' => true,
      ])
      // Spécification du poids de l'ingrédient
      ->add('weightValue', NumberType::class, [
        'label' => 'Poids (en kg)',
        'required' => true,
        'mapped' => true, // Ce champ n'est pas directement lié à l'entité
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
