<?php

namespace ForumMobilBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ForumMobilBundle:Default:index.html.twig');
    }
}
