<?php

namespace App\Controller;

use App\Entity\DataSheet;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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

           TextField::new('Name','nom' ),
           TextField::new('description'),
           ArrayField::new('ingredient','ingredients'),
           ImageField::new('image' , 'Visuel')
       ];
   }

    
}
