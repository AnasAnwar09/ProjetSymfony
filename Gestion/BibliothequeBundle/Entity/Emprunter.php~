<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Emprunter
 */
class Emprunter
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateDebut;

    /**
     * @var \DateTime
     */
    private $dateFin;


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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return Emprunter
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return Emprunter
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }
    /**
     * @var \Gestion\BibliothequeBundle\Entity\Exemplaire
     */
    private $exemplaire;


    /**
     * Set exemplaire
     *
     * @param \Gestion\BibliothequeBundle\Entity\Exemplaire $exemplaire
     * @return Emprunter
     */
    public function setExemplaire(\Gestion\BibliothequeBundle\Entity\Exemplaire $exemplaire)
    {
        $this->exemplaire = $exemplaire;

        return $this;
    }

    /**
     * Get exemplaire
     *
     * @return \Gestion\BibliothequeBundle\Entity\Exemplaire 
     */
    public function getExemplaire()
    {
        return $this->exemplaire;
    }
    /**
     * @var \Gestion\BibliothequeBundle\Entity\Lecteur
     */
    private $lecteur;


    /**
     * Set lecteur
     *
     * @param \Gestion\BibliothequeBundle\Entity\Lecteur $lecteur
     * @return Emprunter
     */
    public function setLecteur(\Gestion\BibliothequeBundle\Entity\Lecteur $lecteur)
    {
        $this->lecteur = $lecteur;

        return $this;
    }

    /**
     * Get lecteur
     *
     * @return \Gestion\BibliothequeBundle\Entity\Lecteur 
     */
    public function getLecteur()
    {
        return $this->lecteur;
    }

    public function __toString()
    {
        return $this->dateDebut;
    }
    /**
     * @var \Gestion\BibliothequeBundle\Entity\Lecteur
     */
    private $emprunteur;


    /**
     * Set emprunteur
     *
     * @param \Gestion\BibliothequeBundle\Entity\Lecteur $emprunteur
     * @return Emprunter
     */
    public function setEmprunteur(\Gestion\BibliothequeBundle\Entity\Lecteur $emprunteur)
    {
        $this->emprunteur = $emprunteur;

        return $this;
    }

    /**
     * Get emprunteur
     *
     * @return \Gestion\BibliothequeBundle\Entity\Lecteur 
     */
    public function getEmprunteur()
    {
        return $this->emprunteur;
    }
}
