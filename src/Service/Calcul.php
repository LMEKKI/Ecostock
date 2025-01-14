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
                    $newItem += [$ingredient['name'], ($ingredient['quantity'] * $orderItem['nombre'])];
                    $sortedOrder += $newItem;
                }
            }
        }

        return $sortedOrder;
    }
}
