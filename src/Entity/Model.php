<?php

/**
 * This file is part of the Cars module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace WebCMS\CarsModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cars_model")
 */
class Model extends \WebCMS\Entity\Entity
{
	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Brand") 
     */
    private $brand;


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
     * Gets the value of brand.
     *
     * @return mixed
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Sets the value of brand.
     *
     * @param mixed $brand the brand
     *
     * @return self
     */
    public function setBrand(Brand $brand)
    {
        $this->brand = $brand;

        return $this;
    }
}
