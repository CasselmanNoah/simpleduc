<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Inscription;
use App\Entity\Employer;

class InscriptionController extends AbstractController
{
    #[Route('/private-liste-inscrits', name: 'liste-inscrits')]
    public function listeContacts(): Response
    {
        $repoInscription = $this->getDoctrine()->getRepository(Employer::class);
        $inscription = $repoInscription->findAll();
        return $this->render('inscription/liste-inscrits.html.twig', [
            'inscription' => $inscription
        ]);
    }
}
