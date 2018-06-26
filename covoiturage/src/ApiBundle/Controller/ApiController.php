<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;



class ApiController extends Controller
{
    public function showAction()
    {
      $encoders = array(new XmlEncoder(), new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());
      $serializer = new Serializer($normalizers, $encoders);

      $em = $this->get('doctrine')->getManager();
      $repository = $em->getRepository('FrontOfficeBundle:Trajet');
      $qb = $em->createQuery(
         "SELECT t,d,a,i FROM FrontOfficeBundle:Trajet t
          JOIN t.ville d
          JOIN t.ville1 a
          JOIN t.internaute i"
      );
      $trajets = $qb->getArrayResult();
      return $this->json($trajets);
    }
    public function searchAction(Request $request)
    {
      $parameters = [];
      if ($content = $request->getContent()) {
          $parameters = json_decode($content, true);
      }
      $em = $this->get('doctrine')->getManager();
      $repository = $em->getRepository('FrontOfficeBundle:Trajet');
      if(strcmp($parameters['type'],'start'))
      {
        $qb = $em->createQuery(
           "SELECT t,d,a,i FROM FrontOfficeBundle:Trajet t
            JOIN t.ville d
            JOIN t.ville1 a
            JOIN t.internaute i
            WHERE d.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $parameters['part']);

        $trajets = $qb->getArrayResult();
      }else if(strcmp($parameters['type'],'stop')){
        $qb = $em->createQuery(
           "SELECT t,d,a,i FROM FrontOfficeBundle:Trajet t
           JOIN t.ville d
           JOIN t.ville1 a
           JOIN t.internaute i
           WHERE a.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $parameters['part']);

        $trajets = $qb->getArrayResult();
      }else if(strcmp($parameters['type'],'both')){
        $qb = $em->createQuery(
           "SELECT t,d,a,i FROM FrontOfficeBundle:Trajet t
           JOIN t.ville d
           JOIN t.ville1 a
           JOIN t.internaute i
           WHERE a.ville LIKE CONCAT('%',:part,'%') OR d.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $parameters['part']);

        $trajets = $qb->getArrayResult();
      }
      return $this->json($trajets);
    }
    public function showTrajetAction($id)
    {
        $em = $this->get('doctrine')->getManager();
        $repository = $em->getRepository('FrontOfficeBundle:Trajet');
        $qb = $em->createQuery(
           "SELECT t,d,a,i,v FROM FrontOfficeBundle:Trajet t
            JOIN t.ville d
            JOIN t.ville1 a
            JOIN t.internaute i
            JOIN i.voiture v
            WHERE t.id = :id"
        )->setParameter('id', $id);
        $trajets = $qb->getArrayResult();
        return $this->json($trajets);
    }
}
