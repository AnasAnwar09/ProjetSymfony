<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lecteur
 */
class Lecteur
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $nomLecteur;

    /**
     * @var string
     */
    private $prenomLecteur;

    /**
     * @var integer
     */
    private $cycleLecteur;


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
     * Set nomLecteur
     *
     * @param string $nomLecteur
     * @return Lecteur
     */
    public function setNomLecteur($nomLecteur)
    {
        $this->nomLecteur = $nomLecteur;

        return $this;
    }

    /**
     * Get nomLecteur
     *
     * @return string 
     */
    public function getNomLecteur()
    {
        return $this->nomLecteur;
    }

    /**
     * Set prenomLecteur
     *
     * @param string $prenomLecteur
     * @return Lecteur
     */
    public function setPrenomLecteur($prenomLecteur)
    {
        $this->prenomLecteur = $prenomLecteur;

        return $this;
    }

    /**
     * Get prenomLecteur
     *
     * @return string 
     */
    public function getPrenomLecteur()
    {
        return $this->prenomLecteur;
    }

    /**
     * Set cycleLecteur
     *
     * @param integer $cycleLecteur
     * @return Lecteur
     */
    public function setCycleLecteur($cycleLecteur)
    {
        $this->cycleLecteur = $cycleLecteur;

        return $this;
    }

    /**
     * Get cycleLecteur
     *
     * @return integer 
     */
    public function getCycleLecteur()
    {
        return $this->cycleLecteur;
    }
    /**
     * @var \Gestion\BibliothequeBundle\Entity\Faculte
     */
    private $faculte;


    /**
     * Set faculte
     *
     * @param \Gestion\BibliothequeBundle\Entity\Faculte $faculte
     * @return Lecteur
     */
    public function setFaculte(\Gestion\BibliothequeBundle\Entity\Faculte $faculte = null)
    {
        $this->faculte = $faculte;

        return $this;
    }

    /**
     * Get faculte
     *
     * @return \Gestion\BibliothequeBundle\Entity\Faculte 
     */
    public function getFaculte()
    {
        return $this->faculte;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $exemplaires;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->exemplaires = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add exemplaires
     *
     * @param \Gestion\BibliothequeBundle\Entity\Exemplaire $exemplaires
     * @return Lecteur
     */
    public function addExemplaire(\Gestion\BibliothequeBundle\Entity\Exemplaire $exemplaires)
    {
        $this->exemplaires[] = $exemplaires;

        return $this;
    }

    /**
     * Remove exemplaires
     *
     * @param \Gestion\BibliothequeBundle\Entity\Exemplaire $exemplaires
     */
    public function removeExemplaire(\Gestion\BibliothequeBundle\Entity\Exemplaire $exemplaires)
    {
        $this->exemplaires->removeElement($exemplaires);
    }

    /**
     * Get exemplaires
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getExemplaires()
    {
        return $this->exemplaires;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $reserver;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $emprunter;


    /**
     * Add reserver
     *
     * @param \Gestion\BibliothequeBundle\Entity\Reserver $reserver
     * @return Lecteur
     */
    public function addReserver(\Gestion\BibliothequeBundle\Entity\Reserver $reserver)
    {
        $this->reserver[] = $reserver;

        return $this;
    }

    /**
     * Remove reserver
     *
     * @param \Gestion\BibliothequeBundle\Entity\Reserver $reserver
     */
    public function removeReserver(\Gestion\BibliothequeBundle\Entity\Reserver $reserver)
    {
        $this->reserver->removeElement($reserver);
    }

    /**
     * Get reserver
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getReserver()
    {
        return $this->reserver;
    }

    /**
     * Add emprunter
     *
     * @param \Gestion\BibliothequeBundle\Entity\Emprunter $emprunter
     * @return Lecteur
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

    public function __toString()
    {
        return $this->getNomLecteur();
    }
}
