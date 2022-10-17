<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Employer;
use App\Entity\Roles;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'profil')]
    public function profil(): Response
    {
        $repoRoles = $this->getDoctrine()->getRepository(Roles::class);
        $roles = $repoRoles->findAll();
        $repoProfil = $this->getDoctrine()->getRepository(Employer::class);
        $profil = $repoProfil->findAll();
        return $this->render('profil/profil.html.twig', [
            'profil' => $profil,
            'roles' => $roles
        ]);
    }
  
}
