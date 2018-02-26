<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Genre
 *
 * @ORM\Table(name="genre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GenreRepository")
 */
class Genre
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
     * @ORM\Column(name="genre_cat", type="string", length=255)
     */
    private $genreCat;


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
     * Set genreCat
     *
     * @param float $genreCat
     *
     * @return Genre
     */
    public function setGenreCat($genreCat)
    {
        $this->genreCat = $genreCat;

        return $this;
    }

    /**
     * Get genreCat
     *
     * @return float
     */
    public function getGenreCat()
    {
        return $this->genreCat;
    }
}

