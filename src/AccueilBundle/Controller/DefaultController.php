<?php

namespace AccueilBundle\Controller;
use LivreBundle\Entity\Livres;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    { $em = $this->getDoctrine()->getManager();

        $livres = $em->getRepository('LivreBundle:Livres')->findAll();
        $livre = new Livres();
        return $this->render('@Accueil\Default\index.html.twig', array(
            'livres' => $livres,
        ));

    }
}
