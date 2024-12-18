<?php

namespace App\Controller;

use App\Entity\OrderForm;
use App\Form\OrderFormType;
use App\Repository\OrderFormRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderFormController extends AbstractController
{
    #[Route('/orderform/new', name: 'orderform_new')]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $orderForm = new OrderForm();
        $form = $this->createForm(OrderFormType::class, $orderForm);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($orderForm);
            $entityManager->flush();

            return $this->redirectToRoute('orderform_success');
        }

        return $this->render('order_form/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/orderform/success', name: 'orderform_success')]
    public function success(): Response
    {
        return $this->render('orderform/success.html.twig');
    }
}
