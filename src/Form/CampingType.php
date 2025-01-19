<?php

namespace App\Form;

use App\Entity\Camping;
use App\Entity\SectionRestaurant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CampingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('adresse')
            ->add(
                'services', // Nom de la relation dans l'entité Camping
                EntityType::class,    // Type de champ
                [
                    'class' => SectionRestaurant::class,   // L'entité associée
                    'choice_label' => 'name',               // Champ affiché dans la liste
                    'multiple' => true,                    // Permet de sélectionner plusieurs
                    'expanded' => true,                     // Affiche des cases à cocher
                    'by_reference' => false,               // Important pour gérer la relation ManyToMany
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Camping::class,
        ]);
    }
}
