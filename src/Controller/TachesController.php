<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Taches;
use App\Form\TachesType;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class TachesController extends AbstractController
{
    #[Route('/tache', name: 'tache')]
    public function tache(Request $request): Response
    {
    $tache = new Taches();
        $form = $this->createForm(TachesType::class, $tache);
        if($request->isMethod('POST')){
            $form->handleRequest($request);    
            if ($form->isSubmitted()&&$form->isValid()){
                $email = (new TemplatedEmail())
                ->context([
                    'projet'=> $tache->getIdprojet(),
                    'tache'=> $tache->getLibelle(),         
                ]);
                $em = $this->getDoctrine()->getManager();
                $em->persist($tache);
                $em->flush();
                $this->addFlash('notice','Tache ajouté');
                return $this->redirectToRoute('tache');
            }
        }
        $repoTache = $this->getDoctrine()->getRepository(Taches::class);
        $taches = $repoTache->findAll();
      
        return $this->render('taches/tache.html.twig', [
            'form' => $form->createView(),
            'taches' => $taches
        ]);
    }
}

