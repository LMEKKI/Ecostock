<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\DataSheetRepository as DataSheet;

class HomeController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(DataSheet $dataSheet): Response
    {
        $allData = $dataSheet->findAll();
        return $this->render('home/index.html.twig', [
            'datasheet' => $allData,
        ]);
    }
}
