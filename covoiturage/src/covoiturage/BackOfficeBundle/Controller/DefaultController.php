<?php

namespace covoiturage\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\ORM\Query\ResultSetMapping;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /*$entityManager = $this->getDoctrine()->getManager();
        $rsm = new ResultSetMapping();
        // build rsm here

        $qb = $entityManager->createNativeQuery('SELECT COUNT(internaute.id) AS nbI FROM internaute', $rsm);

        $nbI = $qb->getResult();*/

        $em = $this->getDoctrine()->getManager();

        //Creation de la query
        //Execution de la query
        //Recuperation resultat

        //Recuperation du nombre d'internaute
        $qb = $em->createQuery("SELECT count(i.id) as total FROM FrontOfficeBundle:Internaute i");
        $res = $qb->getResult();
        $nbI = $res[0]['total'];

        //Recuperation du nombre d'internaute avec au moins 2 trajets
        $qb = $em->createQuery("SELECT count(t.internaute) total FROM FrontOfficeBundle:Trajet t group by t.internaute having count(t.internaute) > 2");
        $res = $qb->getResult();
        $nbI2 = count($res);

        //Recuperation Top 5 ville de depart
        $qb = $em->createQuery("SELECT IDENTITY(t.ville) as ville_id, count(t) total FROM FrontOfficeBundle:Trajet t group by t.ville order by total desc")->setMaxResults(5);
        $res = $qb->getResult();
        $tD = array();
        foreach ($res as $item) {
            $ville = $em->getRepository('FrontOfficeBundle:Ville')->findById($item['ville_id']);
            $tD[] = $ville[0];
        }
    
        //Recuperation Top 5 ville d'arrivée
        $qb = $em->createQuery("SELECT IDENTITY(t.ville) as ville_id, count(t) total FROM FrontOfficeBundle:Trajet t group by t.ville order by total desc")->setMaxResults(5);
        $res = $qb->getResult();
        $tA = array();
        foreach ($res as $item) {
            $ville = $em->getRepository('FrontOfficeBundle:Ville')->findById($item['ville_id']);
            $tA[] = $ville[0];
        }

        //génération Twig
        return $this->render('covoiturageBackOfficeBundle:Default:index.html.twig',
          array("nbI" => $nbI,
                "nbI2" => $nbI2,
                "tD" => $tD,
                "tA" => $tA));
    }
}
