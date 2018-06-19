<?php

namespace FrontOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Internaute
 *
 * @ORM\Table(name="internaute", indexes={@ORM\Index(name="voiture_id", columns={"voiture_id"}), @ORM\Index(name="ville_id", columns={"ville_id"})})
 * @ORM\Entity
 */
class Internaute
{
    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=45, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=45, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=10, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=45, nullable=true)
     */
    private $mail;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \FrontOfficeBundle\Entity\Voiture
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Voiture")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="voiture_id", referencedColumnName="id")
     * })
     */
    private $voiture;

    /**
     * @var \FrontOfficeBundle\Entity\Ville
     *
     * @ORM\ManyToOne(targetEntity="FrontOfficeBundle\Entity\Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ville_id", referencedColumnName="id")
     * })
     */
    private $ville;


}

