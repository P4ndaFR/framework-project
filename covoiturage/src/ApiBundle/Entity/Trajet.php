<?php

namespace ApiBundle\Entity;

/**
 * Trajet
 */
class Trajet
{
    /**
     * @var string
     */
    private $nbKm;

    /**
     * @var \DateTime
     */
    private $date;

    /**
     * @var integer
     */
    private $id;

    /**
     * @var \ApiBundle\Entity\Internaute
     */
    private $internaute;

    /**
     * @var \ApiBundle\Entity\Ville
     */
    private $ville;

    /**
     * @var \ApiBundle\Entity\Ville
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
     * @param \ApiBundle\Entity\Internaute $internaute
     *
     * @return Trajet
     */
    public function setInternaute(\ApiBundle\Entity\Internaute $internaute = null)
    {
        $this->internaute = $internaute;

        return $this;
    }

    /**
     * Get internaute
     *
     * @return \ApiBundle\Entity\Internaute
     */
    public function getInternaute()
    {
        return $this->internaute;
    }

    /**
     * Set ville
     *
     * @param \ApiBundle\Entity\Ville $ville
     *
     * @return Trajet
     */
    public function setVille(\ApiBundle\Entity\Ville $ville = null)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return \ApiBundle\Entity\Ville
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set ville1
     *
     * @param \ApiBundle\Entity\Ville $ville1
     *
     * @return Trajet
     */
    public function setVille1(\ApiBundle\Entity\Ville $ville1 = null)
    {
        $this->ville1 = $ville1;

        return $this;
    }

    /**
     * Get ville1
     *
     * @return \ApiBundle\Entity\Ville
     */
    public function getVille1()
    {
        return $this->ville1;
    }
}

