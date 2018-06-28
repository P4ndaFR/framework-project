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
      //Initialisation
      $encoders = array(new XmlEncoder(), new JsonEncoder());
      $normalizers = array(new ObjectNormalizer());
      $serializer = new Serializer($normalizers, $encoders);

      //Recuperation des données
      $em = $this->get('doctrine')->getManager();
      $repository = $em->getRepository('FrontOfficeBundle:Trajet');
      $qb = $em->createQuery(
         "SELECT t,d,a,i FROM FrontOfficeBundle:Trajet t
          JOIN t.ville d
          JOIN t.ville1 a
          JOIN t.internaute i"
      );
      $trajets = $qb->getArrayResult();
      $response = new Response(json_encode($trajets));
      $response->headers->set('Content-Type', 'application/json');
      $response->headers->set('Access-Control-Allow-Credentials', 'true');
      $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
      $response->headers->set('Access-Control-Allow-Origin', '*');
      $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
      $response->headers->set('Vary', 'Origin');
      return $response;
    }


    public function searchAction(Request $request)
    {
      if ($request->isMethod('options')) {
        $response = new Response();
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, OPTIONS');
        $response->headers->set('Vary', 'Origin');
        return $response;
      }
      $parameters = [];
      if ($content = $request->getContent()) {
          $parameters = json_decode($content, true);
      }
      $em = $this->get('doctrine')->getManager();
      $repository = $em->getRepository('FrontOfficeBundle:Trajet');
      if($parameters['type']=='start')
      {
        //Requete sur les villes de depart
        $qb = $em->createQuery(
           "SELECT t,d,a,i FROM FrontOfficeBundle:Trajet t
            JOIN t.ville d
            JOIN t.ville1 a
            JOIN t.internaute i
            WHERE d.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $parameters['part']);

        $trajets = $qb->getArrayResult();
      }
      if($parameters['type']=='stop'){
        //Requete sur les villes d'arrivée
        $qb = $em->createQuery(
           "SELECT t,d,a,i FROM FrontOfficeBundle:Trajet t
           JOIN t.ville d
           JOIN t.ville1 a
           JOIN t.internaute i
           WHERE a.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $parameters['part']);

        $trajets = $qb->getArrayResult();
      }
      if($parameters['type']=='both'){
        //Requete sur les villes de depart et arrivee
        $qb = $em->createQuery(
           "SELECT t,d,a,i FROM FrontOfficeBundle:Trajet t
           JOIN t.ville d
           JOIN t.ville1 a
           JOIN t.internaute i
           WHERE a.ville LIKE CONCAT('%',:part,'%') OR d.ville LIKE CONCAT('%',:part,'%')"
        )->setParameter('part', $parameters['part']);

        $trajets = $qb->getArrayResult();
      }
      $response = new Response(json_encode($trajets));
      $response->headers->set('Content-Type', 'application/json');
      $response->headers->set('Access-Control-Allow-Credentials', 'true');
      $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
      $response->headers->set('Access-Control-Allow-Origin', '*');
      $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
      $response->headers->set('Vary', 'Origin');
      return $response;
    }
    public function showTrajetAction($id)
    {
      //Recuperation des infos d'un trajet
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
        $response = new Response(json_encode($trajets));
        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Credentials', 'true');
        $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, Accept, Authorization');
        $response->headers->set('Access-Control-Allow-Origin', '*');
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        $response->headers->set('Vary', 'Origin');
        return $response;
    }
}
