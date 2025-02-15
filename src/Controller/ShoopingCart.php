<?php

namespace App\Controller;

use App\Repository\DataSheetRepository;
use App\Repository\UserAccountRepository;
use App\Service\Cart;
use App\Service\Order;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShoopingCart extends AbstractController
{
    #[Route('/order', name: 'app_shooping_cart', methods: ['GET', 'POST'])]
    public function updateCart(DataSheetRepository $dataSheetRepository, Request $request, Cart $cart, Order $order, UserAccountRepository $userAccountRepository): Response
    {
        // Si la requête est POST, traiter l'ajout au panier
        if ($request->isMethod('POST')) {
            $recipeId = $request->request->get('recipeId');
            $quantity = (int)$request->request->get('quantity', 1);
            $userName = $cart->getUserId();
            $userID = $userAccountRepository->findOneByUserName($userName);




            // Ajouter au panier
            $cart->addToCart(['id' => $recipeId, 'quantity' => $quantity, 'user' => $userName]);
        }

        // Si la requête est get, je recupe tout le paanier
        if ($request->isMethod('GET')) {


            $userName = $cart->getUserId();
            $userID = $userAccountRepository->findOneByUserName($userName);

            $cartItems = $cart->getCart();
            $order->createOrder($cartItems, $userName, $userID);
            $cart->resetCart();
        }


        // Récupérer les éléments du panier
        $cartItems = $cart->getCart();


        return $this->render('order/index.html.twig', [
            'dataSheets' => $dataSheetRepository->findAll(),
            'cartItems' => $cartItems,
        ]);
    }
}
