<?php

namespace App\Controller;

use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RestaurantsController extends AbstractController
{
    #[Route('/restaurants', name: 'app_restaurants')]
    public function index(RestaurantRepository $restaurantRepository): Response
    {
        return $this->render('restaurants/index.html.twig', [
            'controller_name' => 'RestaurantsController',
            'restaurantslist' => $restaurantRepository->findAll(),
        ]);
    }


    #[Route('/{id}', name: 'app_restaurant', methods: ['GET'])]
    public function show(RestaurantRepository $restaurantRepository, Request $request): Response
    { 
        $restaurant_id = $request->get('id');
        $response = $restaurantRepository->findOneBy(['id' => $restaurant_id]);

        return $this->render('restaurants/show.html.twig', [
            'controller_name' => 'RestaurantsController',
            'random_tables' => $restaurantRepository->findAll(),
            'chosen_restaurant' => $restaurantRepository->findOneBy(['id' => $restaurant_id]),
            'table_content' => $response,
        ]);
    }
}
