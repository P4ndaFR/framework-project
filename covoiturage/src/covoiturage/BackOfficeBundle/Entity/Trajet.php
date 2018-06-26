<?php

namespace covoiturage\BackOfficeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trajet
 *
 * @ORM\Table(name="trajet", indexes={@ORM\Index(name="internaute_id", columns={"internaute_id"}), @ORM\Index(name="ville_id", columns={"ville_id"}), @ORM\Index(name="ville_id1", columns={"ville_id1"})})
 * @ORM\Entity
 */
class Trajet
{
    /**
     * @var string
     *
     * @ORM\Column(name="nb_km", type="string", length=45, nullable=true)
     */
    private $nbKm;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \covoiturage\BackOfficeBundle\Entity\Internaute
     *
     * @ORM\ManyToOne(targetEntity="covoiturage\BackOfficeBundle\Entity\Internaute")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="internaute_id", referencedColumnName="id")
     * })
     */
    private $internaute;

    /**
     * @var \covoiturage\BackOfficeBundle\Entity\Ville
     *
     * @ORM\ManyToOne(targetEntity="covoiturage\BackOfficeBundle\Entity\Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ville_id", referencedColumnName="id")
     * })
     */
    private $ville;

    /**
     * @var \covoiturage\BackOfficeBundle\Entity\Ville
     *
     * @ORM\ManyToOne(targetEntity="covoiturage\BackOfficeBundle\Entity\Ville")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="ville_id1", referencedColumnName="id")
     * })
     */
    private $ville1;



    /**
     * Set nbKm
     *
     * @param string $nbKm
     *
     * @return Trajet
     */
    public function setNbKm($nbKm)
    {
        $this->nbKm = $nbKm;

        return $this;
    }

    /**
     * Get nbKm
     *
     * @return string
     */
    public function getNbKm()
    {
        return $this->nbKm;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Trajet
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set internaute
     *
     * @param \covoiturage\BackOfficeBundle\Entity\Internaute $internaute
     *
     * @return Trajet
     */
    public function setInternaute(\covoiturage\BackOfficeBundle\Entity\Internaute $internaute = null)
    {
        $this->internaute = $internaute;

        return $this;
    }

    /**
     * Get internaute
     *
     * @return \covoiturage\BackOfficeBundle\Entity\Internaute
     */
    public function getInternaute()
    {
        return $this->internaute;
    }

    /**
     * Set ville
     *
     * @param \covoiturage\BackOfficeBundle\Entity\Ville $ville
     *
     * @return Trajet
     */
    public function setVille(\covoiturage\BackOfficeBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \covoiturage\BackOfficeBundle\Entity\Ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set ville1
     *
     * @param \covoiturage\BackOfficeBundle\Entity\Ville $ville1
     *
     * @return Trajet
     */
    public function setVille1(\covoiturage\BackOfficeBundle\Entity\Ville $ville1 = null)
    {
        $this->ville1 = $ville1;

        return $this;
    }

    /**
     * Get ville1
     *
     * @return \covoiturage\BackOfficeBundle\Entity\Ville
     */
    public function getVille1()
    {
        return $this->ville1;
    }
}
