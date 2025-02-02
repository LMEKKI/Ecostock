<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('category', EntityType::class, [
                'class' => Category::class, // Entité à lister
                'choice_label' => 'name', // Afficher la propriété 'name' pour chaque catégorie
                'placeholder' => 'Sélectionnez une Catégorie existante', // Texte par défaut dans la liste déroulante
                'required' => true, // Permettre de ne pas sélectionner une catégorie existante
                'mapped' => true, // Ce champ n'est pas mappé à l'entité Category
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
