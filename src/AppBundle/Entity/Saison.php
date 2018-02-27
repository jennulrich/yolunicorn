<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Saison
 *
 * @ORM\Table(name="saison")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SaisonRepository")
 */
class Saison
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var float
     *
     * @ORM\Column(name="nb_saison", type="float")
     */
    private $nbSaison;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nbSaison
     *
     * @param float $nbSaison
     *
     * @return Saison
     */
    public function setNbSaison($nbSaison)
    {
        $this->nbSaison = $nbSaison;

        return $this;
    }

    /**
     * Get nbSaison
     *
     * @return float
     */
    public function getNbSaison()
    {
        return $this->nbSaison;
    }

}

