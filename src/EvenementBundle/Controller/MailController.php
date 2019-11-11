<?php

namespace EvenementBundle\Controller;
use EvenementBundle\Entity\Mail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use EvenementBundle\Form\MailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Swift_Message;





class MailController extends Controller
{


    public function indexAction(Request $request)
    {
        $mail = new Mail();
        $form = $this->createForm(MailType::class, $mail);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('Accusé de réception')
                ->setFrom('dabbebisifose@gmail.com')
                ->setTo($mail->getEmail())
                ->setBody(
                    $this->renderView('@Evenement\Default\mail.html.twig', array('nom' => $mail->getNom(), 'prenom' => $mail->getPrenom())

                    ),
                    'text/html'

                );
            $this->get('mailer')->send($message);
            return $this->redirect($this->generateUrl('event_accuse'));


        }
        return $this->render('@Evenement\Default\mailform.html.twig', array('form' => $form
            ->createView()));
    }

    public function successAction()
    {
        return new Response("email envoyé avec succès, Merci de vérifier votre adresse mail
.");
    }}