<?php

namespace ApiBundle\Entity;

/**
 * Voiture
 */
class Voiture
{
    /**
     * @var string
     */
    private $voiture;

    /**
     * @var integer
     */
    private $nbPlaces;

    /**
     * @var integer
     */
    private $id;


    /**
     * Set voiture
     *
     * @param string $voiture
     *
     * @return Voiture
     */
    public function setVoiture($voiture)
    {
        $this->voiture = $voiture;

        return $this;
    }

    /**
     * Get voiture
     *
     * @return string
     */
    public function getVoiture()
    {
        return $this->voiture;
    }

    /**
     * Set nbPlaces
     *
     * @param integer $nbPlaces
     *
     * @return Voiture
     */
    public function setNbPlaces($nbPlaces)
    {
        $this->nbPlaces = $nbPlaces;

        return $this;
    }

    /**
     * Get nbPlaces
     *
     * @return integer
     */
    public function getNbPlaces()
    {
        return $this->nbPlaces;
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
}

