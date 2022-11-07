<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Employer;
use App\Entity\Roles;

class ModifprofilController extends AbstractController
{
    #[Route('/modifprofil', name: 'modifprofil')]
    public function index(): Response
    {
        return $this->render('profil/modifprofil.html.twig', [
            'controller_name' => 'ModifprofilController',
        ]);
    }
    
}




