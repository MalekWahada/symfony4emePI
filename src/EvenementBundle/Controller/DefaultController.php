<?php

namespace EvenementClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@EvenementClient\Default\index.html.twig');
    }
}
