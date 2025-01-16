<?php

namespace App\Controller;

use App\Repository\DataSheetRepository;
use App\Service\Cart;
use App\Service\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShoopingCart extends AbstractController
{
    #[Route('/shooping', name: 'app_shooping_cart', methods: ['GET', 'POST'])]
    public function CreateCart(DataSheetRepository $dataSheetRepository, Request $request, Cart $cart, Order $order): Response
    {
        // Si la requête est POST, traiter l'ajout au panier
        if ($request->isMethod('POST')) {
            $recipeId = $request->request->get('recipeId');
            $quantity = (int)$request->request->get('quantity', 1);

            // Ajouter au panier
            $cart->addToCart(['id' => $recipeId, 'quantity' => $quantity]);
        }

        // Si la requête est get, je recupe tout le paanier
        if ($request->isMethod('GET')) {



            $cartItems = $cart->getCart();
            $order->createOrder($cartItems);
            $cart->resetCart();
        }


        // Récupérer les éléments du panier
        $cartItems = $cart->getCart();


        return $this->render('user_order_form/index.html.twig', [
            'dataSheets' => $dataSheetRepository->findAll(),
            'cartItems' => $cartItems,
        ]);
    }

    #[Route('/removeElement', name: 'call_RemoveElementInCart', methods: ['POST'])]
    public function RemoveElementInCart(Cart $cart, Request $request): Response
    {

        $cartItems = $cart->getCart();
        $recipeId = $request->request->get('recipeId');

        $cartItems = $cart->RemoveElementInCart(['id' => $recipeId]);

        return $this->redirectToRoute('app_shooping_cart');
    }
}
