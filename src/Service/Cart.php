<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{
  private const SESSION_KEY = 'cart';
  private $session;

  public function __construct(RequestStack $requestStack)
  {
    $this->session = $requestStack->getSession();
  }

  public function addToCart(array $item): void
  {
    $cart = $this->getCart();

    foreach ($cart as &$cartItem) {
      if ($cartItem['id'] === $item['id']) {
        $cartItem['quantity'] += $item['quantity'];
        $this->session->set(self::SESSION_KEY, $cart);
        return;
      }
    }




    $cart[] = $item;
    $this->session->set(self::SESSION_KEY, $cart);
  }



  public function updateCart(array $item): void
  {
    $cart = $this->getCart();

    foreach ($cart as &$cartItem) {
      if ($cartItem['id'] === $item['id']) {
        $cartItem['quantity'] = $item['quantity'];
        $this->session->set(self::SESSION_KEY, $cart);
        return;
      }
    }




    $cart[] = $item;
    $this->session->set(self::SESSION_KEY, $cart);
  }

  public function getCart(): array
  {
    return $this->session->get(self::SESSION_KEY, []);
  }


  public function RemoveElementInCart(array $item): void
  {
    // Récupérer le panier de la session
    $cart = $this->getCart();

    // Parcourir le panier pour trouver l'élément à supprimer
    foreach ($cart as $key => $cartItem) {
      // Si l'élément est trouvé dans le panier, on le supprime
      if (isset($cartItem['id']) && $cartItem['id'] === $item['id']) {
        // Supprimer l'élément du panier en utilisant son index
        unset($cart[$key]);

        // Réindexer le tableau pour éviter des indices manquants après le `unset`
        $cart = array_values($cart);

        // Mettre à jour la session avec le panier modifié
        $this->session->set(self::SESSION_KEY, $cart);
        return;
      }
    }
  }


  public function resetCart()
  {
    return $this->session->clear(self::SESSION_KEY, []);
  }
}
