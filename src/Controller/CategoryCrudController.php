<?php

namespace App\Controller;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoryCrudController extends AbstractCrudController

{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom de la Catégorie'),

            // CollectionField::new('services', 'Nom de l\'Etablissement')
            //     ->setEntryType(SectionRestaurantType::class)
            //     ->allowAdd() // Permet d'ajouter de nouvelles entrées
            //     ->allowDelete() // Permet de supprimer des entrées
            //     ->setFormTypeOptions([
            //         'by_reference' => false, // Important pour les relations ManyToMany
            //     ]),

        ];
    }
}
