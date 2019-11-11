<?php

namespace PromotionsClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@PromotionsClient\Default\index.html.twig');
    }
}
