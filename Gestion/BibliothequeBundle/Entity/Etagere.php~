<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Etagere
 */
class Etagere
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $numeroEtagere;


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
     * Set numeroEtagere
     *
     * @param integer $numeroEtagere
     * @return Etagere
     */
    public function setNumeroEtagere($numeroEtagere)
    {
        $this->numeroEtagere = $numeroEtagere;

        return $this;
    }

    /**
     * Get numeroEtagere
     *
     * @return integer 
     */
    public function getNumeroEtagere()
    {
        return $this->numeroEtagere;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $exemplaires_ranges;

    /**
     * @var \Gestion\BibliothequeBundle\Entity\Rayon
     */
    private $rayon;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->exemplaires_ranges = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add exemplaires_ranges
     *
     * @param \Gestion\BibliothequeBundle\Entity\Exemplaire $exemplairesRanges
     * @return Etagere
     */
    public function addExemplairesRange(\Gestion\BibliothequeBundle\Entity\Exemplaire $exemplairesRanges)
    {
        $this->exemplaires_ranges[] = $exemplairesRanges;

        return $this;
    }

    /**
     * Remove exemplaires_ranges
     *
     * @param \Gestion\BibliothequeBundle\Entity\Exemplaire $exemplairesRanges
     */
    public function removeExemplairesRange(\Gestion\BibliothequeBundle\Entity\Exemplaire $exemplairesRanges)
    {
        $this->exemplaires_ranges->removeElement($exemplairesRanges);
    }

    /**
     * Get exemplaires_ranges
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExemplairesRanges()
    {
        return $this->exemplaires_ranges;
    }

    /**
     * Set rayon
     *
     * @param \Gestion\BibliothequeBundle\Entity\Rayon $rayon
     * @return Etagere
     */
    public function setRayon(\Gestion\BibliothequeBundle\Entity\Rayon $rayon = null)
    {
        $this->rayon = $rayon;

        return $this;
    }

    /**
     * Get rayon
     *
     * @return \Gestion\BibliothequeBundle\Entity\Rayon 
     */
    public function getRayon()
    {
        return $this->rayon;
    }
}
