<?php

namespace App\Service;

use App\Repository\OrderFormRepository;
use App\Repository\DataSheetRepository;
use App\Repository\IngredientRepository;

class Calcul
{
    private $orderFormRepository;
    private $dataSheetRepository;
    private $ingredientRepository;

    public function __construct(OrderFormRepository $orderFormRepository, DataSheetRepository $dataSheetRepository, IngredientRepository $ingredientRepository)
    {
        $this->orderFormRepository = $orderFormRepository;
        $this->dataSheetRepository = $dataSheetRepository;
        $this->ingredientRepository = $ingredientRepository;
    }

    /**
     
     * @param int 
     * @return array renvoi un tableau des détails de la commande
     */
    public function getOrderDetails(int $orderId): array
    {

        $orderContent = $this->orderFormRepository->findOneById($orderId)->getContent();

        $orderDetails = [];

        foreach ($orderContent as $item) {
            $recipeName = $this->dataSheetRepository->findOneById($item["id"])->getName();
            $ingredients = $this->ingredientRepository->findByDatasheetId($item["id"]);
            $orderDetails[] = [
                "quantity" => $item["quantity"],
                "name" => $recipeName,
                "ingredients" => $ingredients
            ];
        }

        return $orderDetails;
    }

    /**
     *  @param array tableau de commande 
     */
    public function extractOrderIngredients(array $order): array
    {
        $orderIngredients = [];

        foreach ($order as $orderItem) {
            for ($i = 0; $i < $orderItem["quantity"]; $i++) {
                foreach ($orderItem["ingredients"] as $ingredient) {
                    $orderIngredients[] = $ingredient;
                }
            }
        }

        return $orderIngredients;
    }

    /**
     
     * @param array trie les ingredients d chaque recette que contient mon tableau de commande
     * @return array
     */
    public function sortIngredients(array $order): array
    {
        $orderIngredients = $this->extractOrderIngredients($order);
        $sortedIngredients = $this->mergeDuplicateIngredients($orderIngredients);
        return $sortedIngredients;
    }

    /**
     * je fusion mes tableau afin d'eviter d'avoir plusieur ingrédient du même noms
     * @param array tableau d'ingredient
     * @return array tableu trie par nom  + quantité et unité pour chaque ingredient du même nom
     */
    public function mergeDuplicateIngredients(array $ingredientsArray): array
    {
        $mergedIngredients = [];
        $ingredientNames = [];

        foreach ($ingredientsArray as $ingredient) {
            if (!in_array($ingredient["name"], $ingredientNames)) {
                $ingredientNames[] = $ingredient["name"];
                $mergedIngredients[] = $ingredient;
            } else {
                $index = array_search($ingredient["name"], array_column($mergedIngredients, "name"));
                $mergedIngredients[$index]["quantity"] += $ingredient["quantity"];
            }
        }

        return $mergedIngredients;
    }
}
