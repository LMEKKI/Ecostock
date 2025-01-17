<?php

namespace App\Service;

class Calcul
{

    public function sortOrder(object $order)
    {
        $sortedOrder = [];

        foreach ($order as &$orderItem) {

            foreach ($orderItem as &$ingredient) {

                if ($ingredient['name'] === $sortedOrder['name']) {

                    // ajouter ( $ingredient['quantity'] * $orderItem['nombre'] ) à la quantité pré-existante de l'array dans $sortedOrder dont le 'name' est égal à $ingredient['name{}]

                } else {
                    $newItem = [];
                    $newItem += ["name" => $ingredient['name'], "quantity" => ($ingredient['quantity'] * $orderItem['nombre'])];
                    $sortedOrder += $newItem;
                }
            }
            unset($ingredient);
        }
        unset($orderItem);
        return $sortedOrder;
    }
}
