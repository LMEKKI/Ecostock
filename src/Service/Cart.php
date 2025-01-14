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

  public function getCart(): array
  {
    return $this->session->get(self::SESSION_KEY, []);
  }
}
