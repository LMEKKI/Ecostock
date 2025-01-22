<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\DataSheet;
use App\Form\CategoryType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;


class DataSheetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DataSheet::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Name', 'Nom')
                ->setFormTypeOptions(['required' => true]),
            TextField::new('description'),
            ArrayField::new('ingredient', 'Ingrédients'),
            CollectionField::new('categories', 'Catégories')
                ->setEntryType(CategoryType::class)
                ->allowAdd() // Permet d'ajouter de nouvelles entrées
                ->allowDelete() // Permet de supprimer des entrées
                ->setFormTypeOptions([
                    'by_reference' => false, // Important pour les relations ManyToMany
                ]),
            ImageField::new('image', 'Visuel')
                ->setBasePath('/uploads/images') // URL de base pour l'affichage de l'image
                ->setUploadDir('public/uploads/images') // Répertoire de téléchargement
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'), // Modèle pour le nom du fichier



        ];
    }
}
