<?php

namespace EmpruntBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EmpruntBundle:Default:index.html.twig');
    }
}
