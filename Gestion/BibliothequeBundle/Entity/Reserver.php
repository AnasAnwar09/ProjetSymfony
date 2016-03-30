<?php

namespace Gestion\BibliothequeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reserver
 */
class Reserver
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var \DateTime
     */
    private $dateReserve;


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
     * Set dateReserve
     *
     * @param \DateTime $dateReserve
     * @return Reserver
     */
    public function setDateReserve($dateReserve)
    {
        $this->dateReserve = $dateReserve;

        return $this;
    }

    /**
     * Get dateReserve
     *
     * @return \DateTime 
     */
    public function getDateReserve()
    {
        return $this->dateReserve;
    }
    /**
     * @var \DateTime
     */
    private $dateReservation;

    /**
     * @var \Gestion\BibliothequeBundle\Entity\Livre
     */
    private $livre;

    /**
     * @var \Gestion\BibliothequeBundle\Entity\Lecteur
     */
    private $lecteur;


    /**
     * Set dateReservation
     *
     * @param \DateTime $dateReservation
     * @return Reserver
     */
    public function setDateReservation($dateReservation)
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    /**
     * Get dateReservation
     *
     * @return \DateTime 
     */
    public function getDateReservation()
    {
        return $this->dateReservation;
    }

    /**
     * Set livre
     *
     * @param \Gestion\BibliothequeBundle\Entity\Livre $livre
     * @return Reserver
     */
    public function setLivre(\Gestion\BibliothequeBundle\Entity\Livre $livre)
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
     * Set lecteur
     *
     * @param \Gestion\BibliothequeBundle\Entity\Lecteur $lecteur
     * @return Reserver
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
}
