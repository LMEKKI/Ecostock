<?php

namespace App\Controller;

use App\Repository\DataSheetRepository;
use App\Repository\IngredientRepository;
use App\Repository\OrderFormRepository;
use App\Service\Calcul;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CalculController extends AbstractController
{
  #[Route('/commandes', name: 'app_calcul')]
  public function index(OrderFormRepository $orderFormRepo): Response
  {
    $orders = $orderFormRepo->findAll();

    return $this->render('calcul/commandIndex.html.twig', [
      'orders' => $orders,
    ]);
  }

  #[Route('/commande_{id}', name: 'app_calcul_{id}')]
  public function commande(int $id, OrderFormRepository $orderFormRepo, DataSheetRepository $dataSheetRepo,IngredientRepository $ingredientRepo, Calcul $calcul): Response
  {
    $orderDetails = $calcul->getOrderInformations($id, $orderFormRepo, $dataSheetRepo, $ingredientRepo);

    //envoi du tableau au service pour calculer les quantités
    $orderIngredients = $calcul->sortOrder($orderDetails, $calcul);

    return $this->render('calcul/command.html.twig', [
      'order' => $orderFormRepo->findOneById($id),
      'sortedOrder' => $orderIngredients,
      'orderDetails' => $orderDetails,
    ]);
  }
}
