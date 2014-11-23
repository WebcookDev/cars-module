<?php

/**
 * This file is part of the Cars module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace WebCMS\CarsModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cars_media")
 */
class Media extends \WebCMS\Entity\Entity
{
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $path;

    /**
     * @ORM\ManyToOne(targetEntity="Car", inversedBy="photos") 
     * @ORM\JoinColumn(name="car_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $car;

    /**
     * @ORM\Column(type="boolean")
     */
    private $fromImport;

    /**
     * @ORM\Column(type="boolean")
     */
    private $photo;

    /**
     * @ORM\Column(type="boolean")
     */
    private $main;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created;


    /**
     * Gets the value of name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets the value of name.
     *
     * @param mixed $name the name
     *
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Gets the value of path.
     *
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets the value of path.
     *
     * @param mixed $path the path
     *
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Gets the value of car.
     *
     * @return mixed
     */
    public function getCar()
    {
        return $this->car;
    }

    /**
     * Sets the value of car.
     *
     * @param mixed $car the car
     *
     * @return self
     */
    public function setCar($car)
    {
        $this->car = $car;

        return $this;
    }

    /**
     * Gets the value of from import.
     *
     * @return mixed
     */
    public function getFromImport()
    {
        return $this->fromImport;
    }

    /**
     * Sets the value of from import.
     *
     * @param mixed $fromImport the from import
     *
     * @return self
     */
    public function setFromImport($fromImport)
    {
        $this->fromImport = $fromImport;

        return $this;
    }

    /**
     * Gets the value of photo.
     *
     * @return mixed
     */
    public function getPhoto()
    {
        return $this->photo;
    }

    /**
     * Sets the value of photo.
     *
     * @param mixed $photo the photo
     *
     * @return self
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Gets the value of main.
     *
     * @return mixed
     */
    public function getMain()
    {
        return $this->main;
    }

    /**
     * Sets the value of main.
     *
     * @param mixed $main the main
     *
     * @return self
     */
    public function setMain($main)
    {
        $this->main = $main;

        return $this;
    }

    /**
     * Gets the value of created.
     *
     * @return mixed
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Sets the value of created.
     *
     * @param mixed $created the created
     *
     * @return self
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }
}
