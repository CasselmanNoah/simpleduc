<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Poste;

class PosteController extends AbstractController
{
    #[Route('/poste', name: 'app_poste')]
    public function index(): Response
    {
        $repoPoste = $this->getDoctrine()->getRepository(Poste::class);
        $postes = $repoPoste->findAll();
        return $this->render('poste/index.html.twig', [
            'poste' => $postes,
        ]);
    }
}
