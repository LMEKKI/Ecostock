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
            'orders_placeholder' => '[{"id":0,"pizza":3,"burger":54,"salades":6,"sectionrestaurant":1,"date":1716346478},{"id":1,"pizza":6,"burger":4,"salades":5,"sectionrestaurant":2,"date":1736345478},{"id":2,"pizza":5,"burger":4,"salades":2,"sectionrestaurant":5,"date":1736346278},{"id":3,"pizza":8,"burger":2,"salades":9,"sectionrestaurant":2,"date":1736345878}]',
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