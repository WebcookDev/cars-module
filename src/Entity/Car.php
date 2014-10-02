<?php

/**
 * This file is part of the Cars module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace WebCMS\CarsModule\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="cars_car")
 */
class Car extends \WebCMS\Entity\Entity
{
	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $drivenKm;

	/**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
	private $price;

	/**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
	private $priceVat;

	/**
     * @ORM\Column(type="smallint", nullable=true)
     */
	private $enginePower;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $engineVolume;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dateOfManufacture;

    /**
     * @orm\Column(type="text", nullable=true)
     */
    private $shortInfo;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $bodywork;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $color;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $transmission;

    /**
     * @ORM\Column(type="boolean")
     */
    private $sold;

    /**
     * @ORM\ManyToOne(targetEntity="Model") 
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="Condition") 
     */
    private $condition;

    /**
     * @ORM\ManyToOne(targetEntity="FuelType") 
     */
    private $fuelType;


    //TODO add markup
	
	public function getName() 
	{
		return $this->name;
	}

	public function getDrivenKm() 
	{
		return $this->drivenKm;
	}

	public function getPrice() 
	{
		return $this->price;
	}

	public function getPriceVat() 
	{
		return $this->priceVat;
	}

	public function getEnginePower() 
	{
		return $this->enginePower;
	}

	public function getEngineVolume() 
	{
		return $this->engineVolume;
	}

	public function getDateOfManufacture() 
	{
		return $this->dateOfManufacture;
	}

	public function getShortInfo() 
	{
		return $this->shortInfo;
	}

	public function getBodywork() 
	{
		return $this->bodywork;
	}

	public function getColor() 
	{
		return $this->color;
	}

	public function getTransmission() 
	{
		return $this->transmission;
	}

	public function getSold() 
	{
		return $this->sold;
	}

	public function setName($name) 
	{
		$this->name = $name;
		return $this;
	}

	public function setDrivenKm($drivenKm) 
	{
		$this->drivenKm = $drivenKm;
		return $this;
	}

	public function setPrice($price) 
	{
		$this->price = $price;
		return $this;
	}

	public function setPriceVat($priceVat) 
	{
		$this->priceVat = $priceVat;
		return $this;
	}

	public function setEnginePower($enginePower) 
	{
		$this->enginePower = $enginePower;
		return $this;
	}

	public function setEngineVolume($engineVolume) 
	{
		$this->engineVolume = $engineVolume;
		return $this;
	}

	public function setDateOfManufacture($dateOfManufacture) 
	{
		$this->dateOfManufacture = $dateOfManufacture;
		return $this;
	}

	public function setShortInfo($shortInfo) 
	{
		$this->shortInfo = $shortInfo;
		return $this;
	}

	public function setBodywork($bodywork) 
	{
		$this->bodywork = $bodywork;
		return $this;
	}

	public function setColor($color) 
	{
		$this->color = $color;
		return $this;
	}

	public function setTransmission($transmission) 
	{
		$this->transmission = $transmission;
		return $this;
	}

	public function setSold($sold) 
	{
		$this->sold = $sold;
		return $this;
	}

    /**
     * Gets the value of model.
     *
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Sets the value of model.
     *
     * @param mixed $model the model
     *
     * @return self
     */
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    /**
     * Gets the value of condition.
     *
     * @return mixed
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * Sets the value of condition.
     *
     * @param mixed $condition the condition
     *
     * @return self
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;

        return $this;
    }

    /**
     * Gets the value of fuel type.
     *
     * @return mixed
     */
    public function getFuelType()
    {
        return $this->fuelType;
    }

    /**
     * Sets the value of fuel type.
     *
     * @param mixed $fuelType the fuel type
     *
     * @return self
     */
    public function setFuelType($fuelType)
    {
        $this->fuelType = $fuelType;

        return $this;
    }
}
