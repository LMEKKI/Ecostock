<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Camping;
use App\Entity\DataSheet;
use App\Entity\Section;
use App\Entity\Type;
use App\Entity\Unit;
use App\Entity\UserAccount;
use App\Entity\Weight;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Factory\MenuFactory;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
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

        yield MenuItem::linkToCrud('Les Utilisateurs', ' fa-solid fa-user', UserAccount::class);
        yield MenuItem::linkToCrud('Les Campings', ' fas fa-solid fa-user', Camping::class);
        yield MenuItem::linkToCrud('Sections', 'fas fa-solid fa-user', Section::class);
        yield MenuItem::linkToCrud('Les Catégories', 'fas fa-solid fa-user', Category::class);
        yield MenuItem::linkToCrud('Les Fiche techniques', 'fas fa-solid fa-user', DataSheet::class);
        yield MenuItem::linkToCrud('Les Type de Sections', 'fas fa-solid fa-user', Type::class);
        // yield MenuItem::linkToCrud('Les Unité de Mesures', 'fas fa-solid fa-user', Unit::class);
        // yield MenuItem::linkToCrud('Les Poids ', 'fas fa-solid fa-user', Weight::class);
    }
}
