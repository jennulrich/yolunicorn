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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Film", mappedBy="genres")
     */
    private $films;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Serie", mappedBy="genres")
     */
    private $series;
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

    /**
     * @return mixed
     */
    public function getFilms()
    {
        return $this->films;
    }

    /**
     * @param mixed $films
     */
    public function setFilms($films)
    {
        $this->films = $films;
    }

    /**
     * @return mixed
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * @param mixed $series
     */
    public function setSeries($series)
    {
        $this->series = $series;
    }

}

