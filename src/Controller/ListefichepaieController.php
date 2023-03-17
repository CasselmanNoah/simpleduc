<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\FicheDePaie;
use App\Entity\Employer;
use Doctrine\ORM\EntityManagerInterface;

class ListefichepaieController extends AbstractController
{
    #[Route('/private-listefichepaie', name: 'listefichepaie')]
    public function index(): Response
    {
        $repoPersonne = $this->getDoctrine()->getRepository(Employer::class);
        $personnes = $repoPersonne->findAll();
        $repoFichepaie = $this->getDoctrine()->getRepository(FicheDePaie::class);
        $fichepaie = $repoFichepaie->findAll();
        return $this->render('fichepaie/fichepaie.html.twig', [
            'fichepaie' => $fichepaie,
            'personnes' => $personnes
        ]);
    }
    #[Route('/ficheclient', name: 'ficheclient')]
    public function fichePaieClient(EntityManagerInterface $entityManagerInterface): Response
    {
        /*
        $repoPersonne = $this->getDoctrine()->getRepository(Employer::class);
        $personnes = $repoPersonne->findAll();
        $repoFichepaie = $this->getDoctrine()->getRepository(FicheDePaie::class);
        $fichepaie = $repoFichepaie->findAll();
        */
        $personnes = $entityManagerInterface->getRepository(Employer::class)->findAll();
        $fichepaie = $entityManagerInterface->getRepository(FicheDePaie::class)->findAll();
        $test = $entityManagerInterface->getRepository(Employer::class)->findOneBy(['nom'=>'Ruiz']);
        return $this->render('fichepaie/fichepaie.html.twig', [
            'fichepaie' => $fichepaie,
            'personnes' => $personnes,
            'test' => $test
        ]);
    }
}
