<?php

namespace App\Controller;

use App\Entity\Camping;
use App\Form\SectionRestaurantType;
use App\Form\Type;
use App\Form\TypeType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class CampingCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Camping::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom du Camping'),
            TextField::new('adresse', 'Adresse du Camping'),
            
            CollectionField::new('services', 'Nom de l\'Etablissement')
                ->setEntryType(SectionRestaurantType::class)
                ->allowAdd() // Permet d'ajouter de nouvelles entrées
                ->allowDelete() // Permet de supprimer des entrées
                ->setFormTypeOptions([
                    'by_reference' => false, // Important pour les relations ManyToMany
                ]),

        ];
    }
}