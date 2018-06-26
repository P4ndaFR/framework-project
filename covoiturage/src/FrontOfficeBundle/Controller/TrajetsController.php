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
        foreach($trajets as $trajet){
          $trajet->setDate(date_format($trajet->getDate(),'Y-m-d H:i'));
          //$trajet->internaute = $trajet->getInternaute()->getNom();
        }
        return $this->render('FrontOfficeBundle:Trajets:trajets.html.twig', [ 'trajets' => $trajets ]);
    }
}
