<?php

namespace App\Controller;

use App\Entity\DataSheet;
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
            CollectionField::new('ingredient', 'Ingrédients')
            ->setEntryType(IngredientType::class)
            ->allowAdd()
            ->allowDelete()
            ->setFormTypeOptions([
                'by_reference' => false, // Important pour permettre les modifications sur les collections
            ]),
            ImageField::new('image', 'Visuel')
                ->setBasePath('/uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),
            FormField::addPanel('Ingrédients'),
           
        ];
    }
}
