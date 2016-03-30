<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Faculte
 */
class Faculte
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $designationFaculte;


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
     * Set designationFaculte
     *
     * @param string $designationFaculte
     * @return Faculte
     */
    public function setDesignationFaculte($designationFaculte)
    {
        $this->designationFaculte = $designationFaculte;

        return $this;
    }

    /**
     * Get designationFaculte
     *
     * @return string
     */
    public function getDesignationFaculte()
    {
        return $this->designationFaculte;
    }

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $etudiants;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etudiants = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add etudiants
     *
     * @param \Gestion\BibliothequeBundle\Entity\Lecteur $etudiants
     * @return Faculte
     */
    public function addEtudiant(\Gestion\BibliothequeBundle\Entity\Lecteur $etudiants)
    {
        $this->etudiants[] = $etudiants;

        return $this;
    }

    /**
     * Remove etudiants
     *
     * @param \Gestion\BibliothequeBundle\Entity\Lecteur $etudiants
     */
    public function removeEtudiant(\Gestion\BibliothequeBundle\Entity\Lecteur $etudiants)
    {
        $this->etudiants->removeElement($etudiants);
    }

    /**
     * Get etudiants
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEtudiants()
    {
        return $this->etudiants;
    }

    public function __toString()
    {
        return $this->designationFaculte;
    }
}
