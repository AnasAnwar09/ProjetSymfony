<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Auteur
 */
class Auteur
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nomAuteur;

    /**
     * @var string
     */
    private $prenomAuteur;


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
     * Set nomAuteur
     *
     * @param string $nomAuteur
     * @return Auteur
     */
    public function setNomAuteur($nomAuteur)
    {
        $this->nomAuteur = $nomAuteur;

        return $this;
    }

    /**
     * Get nomAuteur
     *
     * @return string 
     */
    public function getNomAuteur()
    {
        return $this->nomAuteur;
    }

    /**
     * Set prenomAuteur
     *
     * @param string $prenomAuteur
     * @return Auteur
     */
    public function setPrenomAuteur($prenomAuteur)
    {
        $this->prenomAuteur = $prenomAuteur;

        return $this;
    }

    /**
     * Get prenomAuteur
     *
     * @return string 
     */
    public function getPrenomAuteur()
    {
        return $this->prenomAuteur;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $livres_ecrits;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->livres_ecrits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add livres_ecrits
     *
     * @param \Gestion\BibliothequeBundle\Entity\Livre $livresEcrits
     * @return Auteur
     */
    public function addLivresEcrit(\Gestion\BibliothequeBundle\Entity\Livre $livresEcrits)
    {
        $this->livres_ecrits[] = $livresEcrits;

        return $this;
    }

    /**
     * Remove livres_ecrits
     *
     * @param \Gestion\BibliothequeBundle\Entity\Livre $livresEcrits
     */
    public function removeLivresEcrit(\Gestion\BibliothequeBundle\Entity\Livre $livresEcrits)
    {
        $this->livres_ecrits->removeElement($livresEcrits);
    }

    /**
     * Get livres_ecrits
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLivresEcrits()
    {
        return $this->livres_ecrits;
    }
    public function __toString()
    {
        return $this->getNomAuteur();
    }
}
