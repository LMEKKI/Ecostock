<?php

namespace App\Controller;

use App\Repository\DataSheetRepository;
use App\Repository\OrderFormRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalculController extends AbstractController
{
    #[Route('/commandes', name: 'app_calcul')]
    public function index(OrderFormRepository $orderFormRepository, DataSheetRepository $dataSheetRepository): Response
    {

        $recipes = $dataSheetRepository -> findAll();
        $orders = $orderFormRepository -> findAll();

        return $this->render('calcul/commandIndex.html.twig', [
            'recipe' => $recipes,
            'orders' => $orders,
            'orders_placeholder' => ['pizza', 'burger', 'salade'],
        ]);
    }
    #[Route('/commande_{id}', name: 'app_calcul_{id}')]
    public function commande(OrderFormRepository $orderFormRepository, DataSheetRepository $dataSheetRepository): Response
    {

        $recipes = $dataSheetRepository -> findAll();
        $orders = $orderFormRepository -> findAll();

        return $this->render('calcul/command.html.twig', [
            'recipe' => $recipes,
            'orders' => $orders,
        ]);
    }
}
