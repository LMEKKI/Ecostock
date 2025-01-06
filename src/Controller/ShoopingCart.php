<?php

namespace App\Controller;

use App\Repository\DataSheetRepository;
use App\Service\Cart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShoopingCart extends AbstractController
{
    #[Route('/shooping', name: 'app_shooping_cart', methods: ['GET', 'POST'])]
    public function updateCart(DataSheetRepository $dataSheetRepository, Request $request, Cart $cart): Response
    {
        // Si la requête est POST, traiter l'ajout au panier
        if ($request->isMethod('POST')) {
            $recipeId = $request->request->get('recipeId');
            $quantity = (int)$request->request->get('quantity', 1);

            // Ajouter au panier
            $cart->addToCart(['id' => $recipeId, 'quantity' => $quantity]);
        }

        // Récupérer les éléments du panier
        $cartItems = $cart->getCart();



        return $this->render('user_order_form/index.html.twig', [
            'dataSheets' => $dataSheetRepository->findAll(),
            'cartItems' => $cartItems,
        ]);
    }
}
