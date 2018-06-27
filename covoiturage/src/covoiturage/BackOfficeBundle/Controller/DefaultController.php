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

        $query = $entityManager->createNativeQuery('SELECT COUNT(internaute.id) AS nbI FROM internaute', $rsm);

        $nbI = $query->getResult();*/

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery("SELECT count(i.id) as total FROM FrontOfficeBundle:Internaute i");
        $resultat = $query->getResult();
        $nbI = $resultat[0]['total'];

        $query = $em->createQuery("SELECT count(t.internaute) total FROM FrontOfficeBundle:Trajet t group by t.internaute having count(t.internaute) > 2");
        $resultat = $query->getResult();
        $nbI2 = count($resultat);

        $query = $em->createQuery("SELECT IDENTITY(t.ville) as ville_id, count(t) total FROM FrontOfficeBundle:Trajet t group by t.ville order by total desc")->setMaxResults(5);
        $resultat = $query->getResult();
        $top_depart = array();
        foreach ($resultat as $data) {
            $ville = $em->getRepository('FrontOfficeBundle:Ville')->findById($data['ville_id']);
            $top_depart[] = $ville[0];
        }

        $query = $em->createQuery("SELECT IDENTITY(t.ville) as ville_id, count(t) total FROM FrontOfficeBundle:Trajet t group by t.ville order by total desc")->setMaxResults(5);
        $resultat = $query->getResult();
        $top_arrivee = array();
        foreach ($resultat as $data) {
            $ville = $em->getRepository('FrontOfficeBundle:Ville')->findById($data['ville_id']);
            $top_arrivee[] = $ville[0];
        }

        return $this->render('covoiturageBackOfficeBundle:Default:index.html.twig',
          array("nbI" => $nbI,
                "nbI2" => $nbI2,
                "tD" => $top_depart,
                "tA" => $top_arrivee));
    }
}
