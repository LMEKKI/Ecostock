<?php

namespace App\Service;

use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

use Symfony\Component\HttpFoundation\RequestStack;

class Cart
{
  private const SESSION_KEY = 'cart';
  private $session;
  private $security;

  public function __construct(RequestStack $requestStack, Security $security)
  {
    $this->session = $requestStack->getSession();
    $this->security = $security;
  }

  public function getUserId()
  {
    // Récupérer l'utilisateur connecté
    $user = $this->security->getUser()->getUserIdentifier();


    return $user;
  }

  public function addToCart(array $item): void
  {
    $cart = $this->getCart();

    foreach ($cart as &$cartItem) {
      if ($cartItem['id'] === $item['id']) {
        $cartItem['quantity'] += $item['quantity'];
        $cartItem['user'] = $item['user'];
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

  public function resetCart()
  {
    return $this->session->clear(self::SESSION_KEY, []);
  }
}
