<?php

namespace App\Controller;
use App\Entity\Category;
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
        return parent::index();


         $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

         return $this->redirect($adminUrlGenerator->setController(UserAccountCrudController::class)->generateUrl());

        



    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Ecostock');
    }

    public function configureMenuItems(): iterable
    {

        return [

            yield MenuItem::linkToCrud('The Label', 'fas fa-list', UserAccount::class)->setController(UserAccountCrudController::class)

        [


        ];
    }
    
}
