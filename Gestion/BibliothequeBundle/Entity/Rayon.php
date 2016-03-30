<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Rayon
 */
class Rayon
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $designationRayon;


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
     * Set designationRayon
     *
     * @param string $designationRayon
     * @return Rayon
     */
    public function setDesignationRayon($designationRayon)
    {
        $this->designationRayon = $designationRayon;

        return $this;
    }

    /**
     * Get designationRayon
     *
     * @return string 
     */
    public function getDesignationRayon()
    {
        return $this->designationRayon;
    }
    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $etageres;

    /**
     * @var \Gestion\BibliothequeBundle\Entity\Theme
     */
    private $theme_rayon;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->etageres = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add etageres
     *
     * @param \Gestion\BibliothequeBundle\Entity\Etagere $etageres
     * @return Rayon
     */
    public function addEtagere(\Gestion\BibliothequeBundle\Entity\Etagere $etageres)
    {
        $this->etageres[] = $etageres;

        return $this;
    }

    /**
     * Remove etageres
     *
     * @param \Gestion\BibliothequeBundle\Entity\Etagere $etageres
     */
    public function removeEtagere(\Gestion\BibliothequeBundle\Entity\Etagere $etageres)
    {
        $this->etageres->removeElement($etageres);
    }

    /**
     * Get etageres
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEtageres()
    {
        return $this->etageres;
    }

    /**
     * Set theme_rayon
     *
     * @param \Gestion\BibliothequeBundle\Entity\Theme $themeRayon
     * @return Rayon
     */
    public function setThemeRayon(\Gestion\BibliothequeBundle\Entity\Theme $themeRayon = null)
    {
        $this->theme_rayon = $themeRayon;

        return $this;
    }

    /**
     * Get theme_rayon
     *
     * @return \Gestion\BibliothequeBundle\Entity\Theme 
     */
    public function getThemeRayon()
    {
        return $this->theme_rayon;
    }
}
