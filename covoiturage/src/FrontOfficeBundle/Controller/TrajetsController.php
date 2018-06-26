<?php

namespace FrontOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TrajetsController extends Controller
{
    public function showAction()
    {
        $em = $this->get('doctrine')->getManager();
        $repository = $em->getRepository('FrontOfficeBundle:Trajet');
        /*$queryBuilder=$em->createQueryBuilder();
        $query=$queryBuilder->select('t.id,t.nb_km,t.date,i.nom,i.prenom,d.ville,a.ville')
                              ->from('FrontOfficeBundle:Trajet', 't')
                              ->leftJoin('FrontOfficeBundle:Internaute', 'i')
                              ->leftJoin('FrontOfficeBundle:Ville', 'd')
                              ->leftJoin('FrontOfficeBundle:Ville1', 'a')
                              ->where('i.id = :internaute_id AND d.id = :ville_id AND a.id = :ville_id1')
                              ->getQuery();*/
        $trajets = $repository->findAll();
        foreach($trajets as $trajet){
          $trajet->setDate(date_format($trajet->getDate(),'Y-m-d H:i:s'));
        }
        return $this->render('FrontOfficeBundle:Trajets:trajets.html.twig', [ 'trajets' => $trajets ]);
    }
}
