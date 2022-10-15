<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FicheDePaie;
use App\Entity\Employer;

class ListefichepaieController extends AbstractController
{
    #[Route('/private-listefichepaie', name: 'listefichepaie')]
    public function index(): Response
    {
        $repoFichepaie = $this->getDoctrine()->getRepository(FicheDePaie::class);
        $fichepaie = $repoFichepaie->findAll();
        $repoInscrits = $this->getDoctrine()->getRepository(Employer::class);
        $inscrits = $repoInscrits->findAll();
        return $this->render('fichepaie/fichepaie.html.twig', [
            'fichepaie' => $fichepaie,
            'inscrits' => $inscrits
        ]);
    }
}
