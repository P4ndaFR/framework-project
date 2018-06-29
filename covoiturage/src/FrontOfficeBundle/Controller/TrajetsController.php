<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TrajetsController extends Controller
{
    //Lister tout les trajets
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

    //Fonction pour la barre de recherche
    public function searchAction(Request $request)
    {
      $em = $this->get('doctrine')->getManager();
      $repository = $em->getRepository('FrontOfficeBundle:Trajet');
      if($request->request->get('type')==1)
      {
        //Query de recherche sur les villes de depart
        $qb = $em->createQuery(
           "SELECT t FROM FrontOfficeBundle:Trajet t
            JOIN t.ville v WHERE v.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $request->request->get('ville'));

        $trajets = $qb->getResult();
      }else if($request->request->get('type')==0){
        //Query de recherche sur les villes d'arrivée
        $qb = $em->createQuery(
           "SELECT t FROM FrontOfficeBundle:Trajet t
            JOIN t.ville1 v WHERE v.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $request->request->get('ville'));

        $trajets = $qb->getResult();
      }else if($request->request->get('type')==2){
        //Query de recherche sur les villes de depart et arrivée
        $qb = $em->createQuery(
           "SELECT t FROM FrontOfficeBundle:Trajet t
            JOIN t.ville d
            JOIN t.ville1 a
            WHERE d.ville LIKE CONCAT('%',:part,'%') OR a.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $request->request->get('ville'));
      }
      $trajets = $qb->getResult();
      foreach($trajets as $trajet){
        $trajet->setDate(date_format($trajet->getDate(),'Y-m-d H:i'));
      }
      return $this->render('FrontOfficeBundle:Trajets:trajets.html.twig', [ 'trajets' => $trajets ]);
    }
    public function showTrajetAction($id)
    {
      //Afficher les détails d'un trajet
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
