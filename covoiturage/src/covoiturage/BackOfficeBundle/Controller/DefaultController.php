<?php

namespace covoiturage\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('covoiturageBackOfficeBundle:Default:index.html.twig');
    }
}
