<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Projet;
use App\Form\ProjetType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class ProjetController extends AbstractController
{
    #[Route('/projet', name: 'projet')]
    public function projet(Request $request): Response
    {
        $projet = new Projet();
        $form = $this->createForm(ProjetType::class, $projet);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $email = (new TemplatedEmail())
                ->context([
                    'nom'=> $projet->getNom(),
                    'idEmployer'=> $projet->getIdEmployer(),
                ]);
                $em = $this->getDoctrine()->getManager();
                $em->persist($projet);
                $em->flush();
                $this->addFlash('notice','Projet ajouté');
                return $this->redirectToRoute('projet');
            }
        }
        $repoProjet = $this->getDoctrine()->getRepository(Projet::class);
        $projets = $repoProjet->findAll();
        return $this->render('projet/projet.html.twig', [
            'form' => $form->createView(),
            'projets' => $projets
        ]);
    }
}
