<?php

namespace App\Controller;

use App\Entity\DataSheet;
use App\Form\DataSheetType;
use App\Repository\DataSheetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DataSheetController extends AbstractController
{

    #[Route('/newFicheTechnique', name: 'app_datasheet')]
    public function index(DataSheetRepository $dataSheetRepository, Request $request, EntityManagerInterface $em): Response
    {
        $table = new DataSheet();

        $form = $this->createForm(DataSheetType::class, $table);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $directory = $this->getParameter('kernel.project_dir') . '/public/images';

            $file = $form['image']->getData();
            // compute a random name and try to guess the extension (more secure)
            $extension = $file->guessExtension();
            if (!$extension) {
                // extension cannot be guessed
                $extension = 'bin';
            }
            $file->move($directory, rand(1, 99999).'.'.$extension);

            $em->persist($table);
            $em->flush();
            $this->addFlash('success', 'La table a bien été créée');
            // return $this->redirectToRoute('admin.recipe.index');
        }

        return $this->render('datasheet/datasheet.html.twig', [
            'controller_name' => 'NewTableController',
            'form' => $form,
        ]);
    }
}
