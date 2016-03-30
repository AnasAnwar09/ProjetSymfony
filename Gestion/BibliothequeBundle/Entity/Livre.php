<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livre
 */
class Livre
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $titreLivre;

    /**
     * @var string
     */
    private $noticeLivre;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $exemplaires;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $reserver;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $auteur;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $theme_livre;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->exemplaires = new \Doctrine\Common\Collections\ArrayCollection();
        $this->reserver = new \Doctrine\Common\Collections\ArrayCollection();
        $this->auteur = new \Doctrine\Common\Collections\ArrayCollection();
        $this->theme_livre = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set titreLivre
     *
     * @param string $titreLivre
     * @return Livre
     */
    public function setTitreLivre($titreLivre)
    {
        $this->titreLivre = $titreLivre;

        return $this;
    }

    /**
     * Get titreLivre
     *
     * @return string 
     */
    public function getTitreLivre()
    {
        return $this->titreLivre;
    }

    /**
     * Set noticeLivre
     *
     * @param string $noticeLivre
     * @return Livre
     */
    public function setNoticeLivre($noticeLivre)
    {
        $this->noticeLivre = $noticeLivre;

        return $this;
    }

    /**
     * Get noticeLivre
     *
     * @return string 
     */
    public function getNoticeLivre()
    {
        return $this->noticeLivre;
    }

    /**
     * Add exemplaires
     *
     * @param \Gestion\BibliothequeBundle\Entity\Exemplaire $exemplaires
     * @return Livre
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
     * Add reserver
     *
     * @param \Gestion\BibliothequeBundle\Entity\Reserver $reserver
     * @return Livre
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
     * Add auteur
     *
     * @param \Gestion\BibliothequeBundle\Entity\Auteur $auteur
     * @return Livre
     */
    public function addAuteur(\Gestion\BibliothequeBundle\Entity\Auteur $auteur)
    {
        $this->auteur[] = $auteur;

        return $this;
    }

    /**
     * Remove auteur
     *
     * @param \Gestion\BibliothequeBundle\Entity\Auteur $auteur
     */
    public function removeAuteur(\Gestion\BibliothequeBundle\Entity\Auteur $auteur)
    {
        $this->auteur->removeElement($auteur);
    }

    /**
     * Get auteur
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuteur()
    {
        return $this->auteur;
    }

    /**
     * Add theme_livre
     *
     * @param \Gestion\BibliothequeBundle\Entity\Theme $themeLivre
     * @return Livre
     */
    public function addThemeLivre(\Gestion\BibliothequeBundle\Entity\Theme $themeLivre)
    {
        $this->theme_livre[] = $themeLivre;

        return $this;
    }

    /**
     * Remove theme_livre
     *
     * @param \Gestion\BibliothequeBundle\Entity\Theme $themeLivre
     */
    public function removeThemeLivre(\Gestion\BibliothequeBundle\Entity\Theme $themeLivre)
    {
        $this->theme_livre->removeElement($themeLivre);
    }

    /**
     * Get theme_livre
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getThemeLivre()
    {
        return $this->theme_livre;
    }
    public function __toString()
    {
        return $this->getTitreLivre();
    }
}
