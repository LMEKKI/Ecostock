<?php

namespace App\Controller;

use App\Entity\DataSheet;
use App\Entity\Ingredient;
use App\Form\IngredientType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;

class DataSheetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DataSheet::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Nom')
                ->setFormTypeOptions(['required' => true]),
            
            TextField::new('description', 'Description'),

            // Correction ici : 'ingredients' au lieu de 'ingredient'
            CollectionField::new('ingredients', 'Ingrédients')
                ->setEntryType(IngredientType::class) 
                ->allowAdd() 
                ->allowDelete()
                ->setFormTypeOptions([
                    'by_reference' => false, // Important pour gérer correctement les objets liés
                ]),

            // Image du DataSheet
            ImageField::new('image', 'Visuel')
                ->setBasePath('/uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),

            // Panel pour les Ingrédients
            FormField::addPanel('Ingrédients'),
        ];
    }
}
