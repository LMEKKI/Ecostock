<?php

namespace App\Controller;

use App\Entity\DataSheet;
use App\Entity\Ingredient;
use App\Entity\Weight;
use App\Form\IngredientType;
use Doctrine\ORM\EntityManagerInterface;
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
                    'by_reference' => false, // Important pour gérer correctement les objets liés
                ]),

            ImageField::new('image', 'Visuel')
                ->setBasePath('/uploads/images')
                ->setUploadDir('public/uploads/images')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),

            FormField::addPanel('Ingrédients'),
        ];

        function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
        {
            if ($entityInstance instanceof DataSheet) {
                $ingredientNames = [];  // Liste des ingrédients déjà ajoutés à cette DataSheet

                foreach ($entityInstance->getIngredient() as $ingredient) {
                    // Vérifier si l'ingrédient a déjà été ajouté à la DataSheet
                    if (in_array($ingredient->getName(), $ingredientNames)) {
                        // L'ingrédient est en doublon dans la DataSheet, on lève une exception ou on ignore
                        throw new \Exception('L\'ingrédient "' . $ingredient->getName() . '" a déjà été ajouté à cette fiche.');
                    }

                    // Ajouter le nom de l'ingrédient à la liste pour la DataSheet
                    $ingredientNames[] = $ingredient->getName();

                    // Vérification si l'ingrédient existe déjà en base de données
                    $existingIngredient = $entityManager->getRepository(Ingredient::class)
                        ->findOneBy(['name' => $ingredient->getName()]);

                    if ($existingIngredient) {
                        // Si l'ingrédient existe déjà, on associe l'ingrédient existant à cette DataSheet
                        $ingredient = $existingIngredient;
                    } else {
                        // Si l'ingrédient n'existe pas, on le persiste normalement
                        $entityManager->persist($ingredient);
                    }

                    // Gestion du poids de l'ingrédient
                    $weightValue = $ingredient->getWeightValue();
                    if ($weightValue) {
                        $weight = new Weight();
                        $weight->setValue($weightValue);
                        $ingredient->setWeight($weight);

                        // Persister le poids
                        $entityManager->persist($weight);
                    }
                }
            }

            // Persister la fiche technique (DataSheet)
            $entityManager->persist($entityInstance);
            $entityManager->flush();
        }
    }
}
