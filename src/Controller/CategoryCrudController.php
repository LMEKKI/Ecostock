<?php

namespace App\Controller;

use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class CategoryCrudController extends AbstractCrudController

{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            ChoiceField::new('rubrique', 'Rubriques')
                ->setChoices([
                    'Pizza' => 'pizza',
                    'Burger' => 'burger',
                    'Salade' => 'salade',
                    'Dessert' => 'dessert',
                    'Boissons soft' => 'boissons soft',
                    'Boissons alcoolisées' => 'boissons alcoolisées',
                    'Entrées' => 'entrees',
                    'Boissons chaudes' => 'boissons chaudes',
                ])
                ->allowMultipleChoices(true) // Permet de sélectionner plusieurs rubriques
                ->renderExpanded(true), // Affiche sous forme de cases à cocher

              
        ];
    }
  
}
