<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrajetsController extends Controller
{
    public function showAction()
    {
        $em = $this->get('doctrine')->getManager();
        $repository = $em->getRepository('FrontOfficeBundle:Trajet');
        $trajets = $repository->findAll();
        //$tab=['aaa', 'bbb', 'ccc'];
        return $this->render('FrontOfficeBundle:Trajets:trajets.html.twig', [ 'trajets' => $trajets ]);
    }
}
