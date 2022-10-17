<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\InscriptionType;
use App\Entity\Inscription;
use App\Form\PostulantType;
use App\Entity\Postulant;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;

class BaseController extends AbstractController
{
    #[Route('/index', name: 'index')]
    public function index(): Response
    {
        return $this->render('base/index.html.twig', [
            
        ]);
    }
    #[Route('/inscription', name: 'inscription')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $inscription = new Inscription();
        $form = $this->createForm(InscriptionType::class, $inscription);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $email = (new TemplatedEmail())
                ->from($inscription->getEmail())
                ->to('noah.casselman@gmail.com')
                ->htmlTemplate('emails/inscription.html.twig')
                ->context([
                    'nom'=> $inscription->getNom(),
                    'prenom'=> $inscription->getPrenom(),
                ]);
                $inscription->setDateEnvoi(new \Datetime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($inscription);
                $em->flush();

                $mailer->send($email);
                $this->addFlash('notice','Inscription réussie !');
                return $this->redirectToRoute('inscription');
            }
        }
        return $this->render('security/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    #[Route('/postuler', name: 'postuler')]
    public function postuler(Request $request, MailerInterface $mailer): Response
    {
        $postuler = new Postulant();
        $form = $this->createForm(PostulantType::class, $postuler);
        if($request->isMethod('POST')){
            $form->handleRequest($request);
            if ($form->isSubmitted()&&$form->isValid()){
                $nemail = (new TemplatedEmail())
                ->from($postuler->getEmail())
                ->to('noah.casselman@gmail.com')
                ->htmlTemplate('emails/postuler.html.twig')
                ->context([
                    'nom'=> $postuler->getNom(),
                    'prenom'=> $postuler->getPrenom(),
                ]);
                $postuler->setDateEnvoi(new \Datetime());
                $em = $this->getDoctrine()->getManager();
                $em->persist($postuler);
                $em->flush();

                
                $this->addFlash('notice','Votre demande a été enregistrer !');
                return $this->redirectToRoute('postuler');
            }
        }
        return $this->render('poste/postuler.html.twig', [
            'form' => $form->createView()
        ]);
    }
    #[Route('/profil', name: 'profil')] // étape 1
    public function profil(): Response // étape 2
    {
        return $this->render('profil/profil.html.twig', [ // étape 3
            
        ]);
    }
    #[Route('/avis', name: 'avis')] // étape 1
    public function avis(): Response // étape 2
    {
        return $this->render('base/avis.html.twig', [ // étape 3
            
        ]);
    }
    #[Route('/apropos', name: 'apropos')] // étape 1
    public function apropos(): Response // étape 2
    {
        return $this->render('base/apropos.html.twig', [ // étape 3
            
        ]);
    }
   
}
