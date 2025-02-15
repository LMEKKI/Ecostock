<?php

namespace App\Controller;

use App\Entity\DataSheet;
use App\Form\IngredientType;
use App\Form\CategoryType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

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

            CollectionField::new('ingredients', 'Ingrédients')
                ->setEntryType(IngredientType::class)
                ->allowAdd()
                ->allowDelete()
                ->setFormTypeOptions([
                    'by_reference' => false, // Important pour gérer correctement les objets liés
                ]),

            ArrayField::new('category', 'category'),

            AssociationField::new('category', 'Catégories')
                ->setFormTypeOptions([
                    'by_reference' => false, // Important pour gérer correctement les objets liés
                ])
                ->hideOnIndex()
                ->setRequired(false)
                ->setFormTypeOptions([
                    'multiple' => true, // Permet de sélectionner plusieurs catégories

                ]),

            ImageField::new('image', 'Visuel')
                ->setBasePath('/uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setUploadedFileNamePattern('[randomhash].[extension]')
                ->setRequired(false),
        ];
    }
}
