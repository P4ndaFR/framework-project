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

        $qb = $em->createQuery("SELECT count(i.id) as total FROM FrontOfficeBundle:Internaute i");
        $res = $qb->getResult();
        $nbI = $res[0]['total'];

        $qb = $em->createQuery("SELECT count(t.internaute) total FROM FrontOfficeBundle:Trajet t group by t.internaute having count(t.internaute) > 2");
        $res = $qb->getResult();
        $nbI2 = count($res);

        $qb = $em->createQuery("SELECT IDENTITY(t.ville) as ville_id, count(t) total FROM FrontOfficeBundle:Trajet t group by t.ville order by total desc")->setMaxResults(5);
        $res = $qb->getResult();
        $tD = array();
        foreach ($res as $item) {
            $ville = $em->getRepository('FrontOfficeBundle:Ville')->findById($item['ville_id']);
            $tD[] = $ville[0];
        }

        $qb = $em->createQuery("SELECT IDENTITY(t.ville) as ville_id, count(t) total FROM FrontOfficeBundle:Trajet t group by t.ville order by total desc")->setMaxResults(5);
        $res = $qb->getResult();
        $tA = array();
        foreach ($res as $item) {
            $ville = $em->getRepository('FrontOfficeBundle:Ville')->findById($item['ville_id']);
            $tA[] = $ville[0];
        }

        return $this->render('covoiturageBackOfficeBundle:Default:index.html.twig',
          array("nbI" => $nbI,
                "nbI2" => $nbI2,
                "tD" => $tD,
                "tA" => $tA));
    }
}
