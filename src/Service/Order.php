<?php

namespace App\Service;

use App\Entity\OrderForm;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

class Order
{

  private EntityManagerInterface $entityManager;

  public function __construct(EntityManagerInterface $entityManager)
  {
    $this->entityManager = $entityManager;
  }
  function createOrder($cart, $userName, $userId): Response
  {
    $order = new OrderForm();
    $order->setcreatedBy($userName);
    $order->setUserAccount($userId);
    $order->setContent($cart);
    $order->setCreatedAt(new \DateTimeImmutable());

    if (!empty($cart)) {
      $this->entityManager->persist($order);
      $this->entityManager->flush();
    }

    return new Response('je debug ca marche sinon fait chier');
    $cartItems = [];
  }
};
