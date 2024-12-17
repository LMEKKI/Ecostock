<?php

namespace App\Controller;

use App\Entity\OrderForm;
use App\Entity\UserAccount;
use App\Form\RestaurantsOrdersType;
use App\Repository\DataSheetRepository;
use App\Repository\UserAccountRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;




class UserOrderFormController extends AbstractController
{
    #[Route('/user/order/form', name: 'app_user_order_form')]
    public function index(DataSheetRepository $dataSheetRepository, Request $request, EntityManagerInterface $em, UserAccountRepository $userAccount): Response
    {

        // $order = new OrderForm();
        // // $user = $userAccount->findOneBy(['username' => $this->getUserAccount()->getUserIdentifier()]);
        // // $user = $userAccount->findOneBy(['username' => "mathis"]);

        // $form = $this->createForm(RestaurantsOrdersType::class, $order);
        // $form->handleRequest($request);
        // if($form->isSubmitted() && $form->isValid()) {
        //     // $order->setUserAccount($user);
        //     $em->persist($order);
        //     $em->flush();
        //     $this->addFlash('success', 'La commande a bien été passée');
        //     // return $this->redirectToRoute('admin.recipe.index');
        // }

        // $commande = "";
        
        // $commande = "carotte";

        return $this->render('user_order_form/index.html.twig', [
            'controller_name' => 'UserOrderFormController',
            'dataSheets' => $dataSheetRepository->findAll(),
            // 'commande' => $commande,
            // 'form' => $form,
        ]);
    }
}