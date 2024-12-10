<?php

namespace App\Controller;

use App\Entity\OrderForm;
use App\Repository\DataSheetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserOrderFormController extends AbstractController
{
    #[Route('/user/order/form', name: 'app_user_order_form')]
    public function index(DataSheetRepository $dataSheetRepository, ): Response
    {

        $order = new OrderForm();

        // $user = $userRepository->findOneBy(['username' => $this->getUser()->getUserIdentifier()]);

        

        return $this->render('user_order_form/index.html.twig', [
            'controller_name' => 'UserOrderFormController',
            'dataSheets' => $dataSheetRepository->findAll(),
            'order' => $order
        ]);
    }
}
