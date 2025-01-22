<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('existingCategory', EntityType::class, [
                'class' => Category::class, // Entité à lister
                'choice_label' => 'name', // Afficher la propriété 'name' pour chaque catégorie
                'placeholder' => 'Sélectionnez une catégorie existante', // Texte par défaut dans la liste déroulante
                'required' => false, // Permettre de ne pas sélectionner une catégorie existante
                'mapped' => false, // Ce champ n'est pas mappé à l'entité Category
                'label' => 'Catégories existantes',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class, // L'entité Category sera utilisée pour ce formulaire
        ]);
    }
}
