<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

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
    public function searchAction(Request $request)
    {
      $em = $this->get('doctrine')->getManager();
      $repository = $em->getRepository('FrontOfficeBundle:Trajet');
      if($request->request->get('type')==1)
      {
        $qb = $em->createQuery(
           "SELECT t FROM FrontOfficeBundle:Trajet t
            JOIN t.ville v WHERE v.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $request->request->get('ville'));

        $trajets = $qb->getResult();
        foreach($trajets as $trajet){
          $trajet->setDate(date_format($trajet->getDate(),'Y-m-d H:i'));
        }
      }else if($request->request->get('type')==0){
        $qb = $em->createQuery(
           "SELECT t FROM FrontOfficeBundle:Trajet t
            JOIN t.ville1 v WHERE v.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $request->request->get('ville'));

        $trajets = $qb->getResult();
        foreach($trajets as $trajet){
          $trajet->setDate(date_format($trajet->getDate(),'Y-m-d H:i'));
        }
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
            'No internaute found for id '.$id
          );
        }
        return $this->render('FrontOfficeBundle:Trajets:internaute.html.twig', [ 'internaute' => $internaute ]);
    }
    public function showTrajetAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $repository = $em->getRepository('FrontOfficeBundle:Trajet');
        $trajet = $repository->find($id);
        if (!$trajet) {
          throw $this->createNotFoundException(
            'No internaute found for id '.$id
          );
        }
        $trajet->setDate(date_format($trajet->getDate(),'Y-m-d H:i'));
        return $this->render('FrontOfficeBundle:Trajets:trajet.html.twig', [ 'trajet' => $trajet ]);
    }
}
