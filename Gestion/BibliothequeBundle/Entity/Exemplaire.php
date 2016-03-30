<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exemplaire
 */
class Exemplaire
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $numeroExemplaire;


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
     * Set numeroExemplaire
     *
     * @param string $numeroExemplaire
     * @return Exemplaire
     */
    public function setNumeroExemplaire($numeroExemplaire)
    {
        $this->numeroExemplaire = $numeroExemplaire;

        return $this;
    }

    /**
     * Get numeroExemplaire
     *
     * @return string
     */
    public function getNumeroExemplaire()
    {
        return $this->numeroExemplaire;
    }
    /**
     * @var \Gestion\BibliothequeBundle\Entity\Livre
     */
    private $livre;


    /**
     * Set livre
     *
     * @param \Gestion\BibliothequeBundle\Entity\Livre $livre
     * @return Exemplaire
     */
    public function setLivre(\Gestion\BibliothequeBundle\Entity\Livre $livre = null)
    {
        $this->livre = $livre;

        return $this;
    }

    /**
     * Get livre
     *
     * @return \Gestion\BibliothequeBundle\Entity\Livre 
     */
    public function getLivre()
    {
        return $this->livre;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $emprunter;

    /**
     * @var \Gestion\BibliothequeBundle\Entity\Etagere
     */
    private $etagere;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->emprunter = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add emprunter
     *
     * @param \Gestion\BibliothequeBundle\Entity\Emprunter $emprunter
     * @return Exemplaire
     */
    public function addEmprunter(\Gestion\BibliothequeBundle\Entity\Emprunter $emprunter)
    {
        $this->emprunter[] = $emprunter;

        return $this;
    }

    /**
     * Remove emprunter
     *
     * @param \Gestion\BibliothequeBundle\Entity\Emprunter $emprunter
     */
    public function removeEmprunter(\Gestion\BibliothequeBundle\Entity\Emprunter $emprunter)
    {
        $this->emprunter->removeElement($emprunter);
    }

    /**
     * Get emprunter
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEmprunter()
    {
        return $this->emprunter;
    }

    /**
     * Set etagere
     *
     * @param \Gestion\BibliothequeBundle\Entity\Etagere $etagere
     * @return Exemplaire
     */
    public function setEtagere(\Gestion\BibliothequeBundle\Entity\Etagere $etagere = null)
    {
        $this->etagere = $etagere;

        return $this;
    }

    /**
     * Get etagere
     *
     * @return \Gestion\BibliothequeBundle\Entity\Etagere 
     */
    public function getEtagere()
    {
        return $this->etagere;
    }

    public function __toString()
    {
        return $this->getNumeroExemplaire();
    }
}
