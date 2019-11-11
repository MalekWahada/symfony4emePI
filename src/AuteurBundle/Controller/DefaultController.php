<?php

namespace AuteurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('AuteurBundle:Default:index.html.twig');
    }
}
