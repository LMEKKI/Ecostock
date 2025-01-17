<?php


namespace App\Form;

use App\Entity\Category;
use App\Entity\DataSheet;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('rubrique', ChoiceType::class, [
                'choices' => [
                    'Pizza' => 'pizza',
                    'Burger' => 'burger',
                    'Salade' => 'salade',
                    'Dessert' => 'dessert',
                    'Boissons soft' => 'boissons soft',
                    'Boissons alcoolisées' => 'boissons alcoolisées',
                    'Entrées' => 'entrees',
                    'Boissons chaudes' => 'boissons chaudes',
                ],
                'multiple' => true,
                'expanded' => true, // Affiche les options sous forme de cases à cocher
                'label' => 'Catégories',
            ]);
           
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
