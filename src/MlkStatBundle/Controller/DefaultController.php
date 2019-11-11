<?php

namespace MlkStatBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MlkStatBundle:Default:index.html.twig');
    }
}
