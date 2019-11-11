<?php

namespace EchangeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@EchangeBundle\Default\index.html.twig');
    }
}
