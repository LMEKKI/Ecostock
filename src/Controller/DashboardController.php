<?php

namespace App\Controller;
use App\Entity\Category;
use App\Entity\Restaurant;
use App\Entity\Service;
use App\Entity\UserAccount;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {




        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(ServiceCrudController::class)->generateUrl());




    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecostock');
    }

    public function configureMenuItems(): iterable
    {

            yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-user', UserAccount::class);
            yield MenuItem::linkToCrud('Liste des restaurants', 'fa-solid fa-user', Restaurant::class);
            yield MenuItem::linkToCrud('Les services', 'fa-solid fa-user', Service::class);
            yield MenuItem::linkToCrud('Categories', 'fa-solid fa-user', Category::class);

    }
    
}
