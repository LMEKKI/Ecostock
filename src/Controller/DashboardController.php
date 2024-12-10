<?php

namespace App\Controller;
use App\Entity\Admin;
use App\Entity\Category;
use App\Entity\Camping;
use App\Entity\DataSheet;
use App\Entity\Ingredient;
use App\Entity\SectionRestaurant;
use App\Entity\UserAccount;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use http\Client\Curl\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {




        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(SectionRestaurantCrudController::class)->generateUrl());




    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecostock');
    }

    public function configureMenuItems(): iterable
    {

            yield MenuItem::linkToCrud('Utilisateurs', ' fa-solid fa-user', UserAccount::class);
            yield MenuItem::linkToCrud('Camping', ' fas fa-solid fa-user', Camping::class);
            yield MenuItem::linkToCrud('Section_Resturant', 'fas fa-solid fa-user', SectionRestaurant::class);
            yield MenuItem::linkToCrud('Categories', 'fas fa-solid fa-user', Category::class);
        yield MenuItem::linkToCrud('Fiche Techniques', 'fas fa-solid fa-user', DataSheet::class);
        yield MenuItem::linkToCrud(' Techniques', 'fas fa-solid fa-user', Ingredient::class);

    }


    
}
