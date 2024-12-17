<?php

namespace App\Form;

use App\Entity\DataSheet;
use App\Entity\OrderForm;
use App\Entity\UserAccount;
use App\Repository\DataSheetRepository;
use Doctrine\ORM\Query\Expr\Func;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RestaurantsOrdersType extends AbstractType
{
    
    public function __construct(
        private Security $security,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder
            ->add('name')
            // ->add('createdAt', null, [
            //     'widget' => 'single_text'
            // ]) 
            ->add('content')
            ->add('userAccount', EntityType::class, [
                'class' => UserAccount::class,
                'choice_label' => 'id',
            ])
        ;

        $user = $this->security->getUser();
        // if (!$user) {
        //     throw new \LogicException(
        //         'The FriendMessageFormType cannot be used without an authenticated user!'
        //     );
        // }

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($user): void {
            // ... add a choice list of friends of the current application user
            // if (null !== $event->getData()->getFriend()) {

            //     return;
            // }
            $form = $event->getForm();

            $formOptions = [
                'class' => DataSheet::class,
                'choice_label' => 'fullName',
                'query_builder' => function (DataSheetRepository $dataSheetRepository) use ($user): void {
                    // call a method on your repository that returns the query builder
                    // return $userRepository->createFriendsQueryBuilder($user);
                },
            ];

            // create the field, this is similar the $builder->add()
            // field name, field type, field options
            $form->add('datasheets', EntityType::class, $formOptions);
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrderForm::class,
        ]);
    }
}
