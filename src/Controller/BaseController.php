<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\InscriptionType;
use App\Entity\Inscription;
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
                $contact->setDateEnvoi(new \Datetime());
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
    #[Route('/login', name: 'login')]
    public function login(): Response
    {
        return $this->render('security/login.html.twig', [
            
        ]);
    }
   
   
    #[Route('/apropos', name: 'apropos')] // étape 1
    public function apropos(): Response // étape 2
    {
        return $this->render('base/apropos.html.twig', [ // étape 3
            
        ]);
    }
   
}
