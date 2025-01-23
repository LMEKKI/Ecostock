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
  public function index(OrderFormRepository $orderFormRepository): Response
  {

    $orders = $orderFormRepository->findAll();

    return $this->render('calcul/commandIndex.html.twig', [
      'orders' => $orders,
    ]);
  }

  #[Route('/commande_{id}', name: 'app_calcul_{id}')]
  public function commande(int $id, OrderFormRepository $orderFormRepository, DataSheetRepository $dataSheetRepository,IngredientRepository $ingredientRepository, Calcul $calcul): Response
  {
    
    // réception du contenu de la commande
    $ordering = $orderFormRepository->findOneById($id)->getContent();

    //création du tableau des ingrédients, pour la fonction de calcul
    $orderDetails = array();
    foreach ($ordering as $key => $value) {
      $recipeName = $dataSheetRepository->findOneById($value["id"])->getName();
      $IngredientsTemp = $dataSheetRepository->getIngredientsFromDatasheet($value["id"]);
      // $ingredientsTemp = $dataSheetRepository->findOneById($value["id"]);
      $recipeIngredients = array("name"=> $ingredientRepository->findOneById($value["id"])->getName(), "quantity"=>5, "unit"=>"gr");

      array_push($orderDetails, array("nombre" => $value["quantity"], "nom" => $recipeName, "ingredients" => $recipeIngredients));
      dd($IngredientsTemp);
    };

    //envoi du tableau au service pour calculer les quantités
    $orderIngredients = $calcul->sortOrder($orderDetails, $calcul);

    return $this->render('calcul/command.html.twig', [
      'order' => $orderFormRepository->findOneById($id),
      'sortedOrder' => $orderIngredients,
      'orderDetails' => $orderDetails,
    ]);
  }
}
