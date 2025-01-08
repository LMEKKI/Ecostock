<?php

namespace App\Controller;

use App\Repository\DataSheetRepository;
use App\Repository\OrderFormRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalculController extends AbstractController
{
    #[Route('/calcul', name: 'app_calcul')]
    public function index(OrderFormRepository $orderFormRepository, DataSheetRepository $dataSheetRepository): Response
    {

        $recipes = $dataSheetRepository -> findAll();
        $orders = $orderFormRepository -> findAll();

        return $this->render('calcul/index.html.twig', [
            'recipe' => $recipes,
            'orders' => $orders,
        ]);
    }
}
