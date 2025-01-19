<?php

namespace App\Form;

use App\Entity\SectionRestaurant;
use App\Entity\Camping;
use App\Entity\Type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SectionRestaurantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('adresse')
            ->add(
                'Type', // Nom de la relation dans SectionRestaurant
                EntityType::class, // Type de champ
                [
                    'class' => Type::class,   // L'entité associée
                    'choice_label' => 'name',    // Le champ à afficher
                    'multiple' => true,          // Permet la sélection multiple
                    'expanded' => true,          // Affiche des cases à cocher
                    'by_reference' => false,     // Important pour la relation ManyToMany
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SectionRestaurant::class,
        ]);
    }
}
