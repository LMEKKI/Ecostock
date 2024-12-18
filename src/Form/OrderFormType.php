<?php

namespace App\Form;

use App\Entity\OrderForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderFormType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    // Ajoutez les champs de votre formulaire ici
    $builder
      ->add('createdAt')
      ->add('content');
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => OrderForm::class,
    ]);
  }
}
