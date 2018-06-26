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
        }
        return $this->render('FrontOfficeBundle:Trajets:trajets.html.twig', [ 'trajets' => $trajets ]);
    }
    public function showInternauteAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $repository = $em->getRepository('FrontOfficeBundle:Internaute');
        $internaute = $repository->find($id);
        if (!$internaute) {
          throw $this->createNotFoundException(
            'No internaute found for id '.$internaute
          );
        }
        return $this->render('FrontOfficeBundle:Trajets:internaute.html.twig', [ 'internaute' => $internaute ]);
    }
}
