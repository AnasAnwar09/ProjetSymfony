<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Theme
 */
class Theme
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $descriptionTheme;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $rayon;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $livre_theme;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->rayon = new \Doctrine\Common\Collections\ArrayCollection();
        $this->livre_theme = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set descriptionTheme
     *
     * @param string $descriptionTheme
     * @return Theme
     */
    public function setDescriptionTheme($descriptionTheme)
    {
        $this->descriptionTheme = $descriptionTheme;

        return $this;
    }

    /**
     * Get descriptionTheme
     *
     * @return string 
     */
    public function getDescriptionTheme()
    {
        return $this->descriptionTheme;
    }

    /**
     * Add rayon
     *
     * @param \Gestion\BibliothequeBundle\Entity\Rayon $rayon
     * @return Theme
     */
    public function addRayon(\Gestion\BibliothequeBundle\Entity\Rayon $rayon)
    {
        $this->rayon[] = $rayon;

        return $this;
    }

    /**
     * Remove rayon
     *
     * @param \Gestion\BibliothequeBundle\Entity\Rayon $rayon
     */
    public function removeRayon(\Gestion\BibliothequeBundle\Entity\Rayon $rayon)
    {
        $this->rayon->removeElement($rayon);
    }

    /**
     * Get rayon
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRayon()
    {
        return $this->rayon;
    }

    /**
     * Add livre_theme
     *
     * @param \Gestion\BibliothequeBundle\Entity\Livre $livreTheme
     * @return Theme
     */
    public function addLivreTheme(\Gestion\BibliothequeBundle\Entity\Livre $livreTheme)
    {
        $this->livre_theme[] = $livreTheme;

        return $this;
    }

    /**
     * Remove livre_theme
     *
     * @param \Gestion\BibliothequeBundle\Entity\Livre $livreTheme
     */
    public function removeLivreTheme(\Gestion\BibliothequeBundle\Entity\Livre $livreTheme)
    {
        $this->livre_theme->removeElement($livreTheme);
    }

    /**
     * Get livre_theme
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getLivreTheme()
    {
        return $this->livre_theme;
    }
    public function __toString()
    {
        return $this->getDescriptionTheme();
    }
}
