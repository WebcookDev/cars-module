<?php

/**
 * This file is part of the Cars module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace WebCMS\CarsModule\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="WebCMS\CarsModule\Entity\CarRepository")
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
    private $fullname;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $motorization;

    /**
     * @gedmo\Slug(fields={"fullname"})
     * @orm\Column(length=255, unique=true)
     */
    private $slug;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $serviceId;

	/**
	 * @ORM\Column(type="string", length=255, nullable=true)
	 */
	private $drivenKm;

	/**
     * @ORM\Column(type="decimal", scale=2, nullable=true)
     */
	private $price;

	/**
     * @ORM\Column(type="decimal", scale=0, nullable=true)
     */
	private $vat;

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
     * @ORM\Column(type="date", length=255, nullable=true)
     */
    private $dateOfManufacture;

    /**
     * @ORM\Column(type="date", length=255, nullable=true)
     */
    private $dateIn;

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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $sold;

    /**
     * @ORM\ManyToOne(targetEntity="Model") 
     */
    private $model;

    /**
     * @ORM\ManyToOne(targetEntity="Brand") 
     */
    private $brand;

    /**
     * @ORM\ManyToMany(targetEntity="Equipment") 
     */
    private $equipments;

    /**
     * @ORM\ManyToOne(targetEntity="Condition") 
     */
    private $condition;

    /**
     * @ORM\ManyToOne(targetEntity="FuelType") 
     */
    private $fuelType;

    /**
     * @ORM\OneToMany(targetEntity="Media", mappedBy="car") 
     * @var Array
     */
    private $photos;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hide;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $videoUrl;

    /**
     * @ORM\Column(type="boolean")
     */
    private $top;

    /**
     * @ORM\Column(type="boolean")
     */
    private $homepage;


    public function __construct()
    {
        $this->equipments = new ArrayCollection;
        $this->hide = false;
        $this->top = false;
        $this->homepage = false;
    }

    public function addEquipment(Equipment $equipment)
    {
        if (!$this->equipments->contains($equipment)) {
            $this->equipments->add($equipment);
        }
    }

    public function removeEquipment(Equipment $equipment)
    {
        if ($this->equipment->contains($equipment)) {
            $this->equipments->removeElement($equipment);
        }
    }

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
     * Gets the value of fullname.
     *
     * @return mixed
     */
    public function getFullname()
    {
        return $this->fullname;
    }

    /**
     * Sets the value of fullname.
     *
     * @param mixed $fullname the fullname
     *
     * @return self
     */
    public function setFullname($fullname)
    {
        $this->fullname = $fullname;

        return $fullname;
    }

    /**
     * Gets the value of motorization.
     *
     * @return mixed
     */
    public function getMotorization()
    {
        return $this->motorization;
    }

    /**
     * Sets the value of motorization.
     *
     * @param mixed $motorization the motorization
     *
     * @return self
     */
    public function setMotorization($motorization)
    {
        $this->motorization = $motorization;

        return $motorization;
    }

    /**
     * Gets the value of drivenKm.
     *
     * @return mixed
     */
    public function getDrivenKm()
    {
        return $this->drivenKm;
    }

    /**
     * Sets the value of drivenKm.
     *
     * @param mixed $drivenKm the driven km
     *
     * @return self
     */
    public function setDrivenKm($drivenKm)
    {
        $this->drivenKm = $drivenKm;

        return $this;
    }

    /**
     * Gets the value of price.
     *
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Sets the value of price.
     *
     * @param mixed $price the price
     *
     * @return self
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Gets the value of priceVat.
     *
     * @return mixed
     */
    public function getPriceVat()
    {
        return $this->price * (21 / 100 + 1);
    }

    /**
     * Sets the value of priceVat.
     *
     * @param mixed $priceVat the price vat
     *
     * @return self
     */
    public function setPriceVat($priceVat)
    {
        $this->priceVat = $priceVat;

        return $this;
    }

    /**
     * Gets the value of enginePower.
     *
     * @return mixed
     */
    public function getEnginePower()
    {
        return $this->enginePower;
    }

    /**
     * Sets the value of enginePower.
     *
     * @param mixed $enginePower the engine power
     *
     * @return self
     */
    public function setEnginePower($enginePower)
    {
        $this->enginePower = $enginePower;

        return $this;
    }

    /**
     * Gets the value of engineVolume.
     *
     * @return mixed
     */
    public function getEngineVolume()
    {
        return $this->engineVolume;
    }

    /**
     * Sets the value of engineVolume.
     *
     * @param mixed $engineVolume the engine volume
     *
     * @return self
     */
    public function setEngineVolume($engineVolume)
    {
        $this->engineVolume = $engineVolume;

        return $this;
    }

    /**
     * Gets the value of dateOfManufacture.
     *
     * @return mixed
     */
    public function getDateOfManufacture()
    {
        return $this->dateOfManufacture;
    }

    /**
     * Sets the value of dateOfManufacture.
     *
     * @param mixed $dateOfManufacture the date of manufacture
     *
     * @return self
     */
    public function setDateOfManufacture($dateOfManufacture)
    {
        $this->dateOfManufacture = $dateOfManufacture;

        return $this;
    }

    /**
     * Gets the value of dateIn.
     *
     * @return mixed
     */
    public function getDateIn()
    {
        return $this->dateIn;
    }

    /**
     * Sets the value of dateIn.
     *
     * @param mixed $dateIn the date in
     *
     * @return self
     */
    public function setDateIn($dateIn)
    {
        $this->dateIn = $dateIn;

        return $this;
    }

    /**
     * Gets the value of shortInfo.
     *
     * @return mixed
     */
    public function getShortInfo()
    {
        return $this->shortInfo;
    }

    /**
     * Sets the value of shortInfo.
     *
     * @param mixed $shortInfo the short info
     *
     * @return self
     */
    public function setShortInfo($shortInfo)
    {
        $this->shortInfo = $shortInfo;

        return $this;
    }

    /**
     * Gets the value of bodywork.
     *
     * @return mixed
     */
    public function getBodywork()
    {
        return $this->bodywork;
    }

    /**
     * Sets the value of bodywork.
     *
     * @param mixed $bodywork the bodywork
     *
     * @return self
     */
    public function setBodywork($bodywork)
    {
        $this->bodywork = $bodywork;

        return $this;
    }

    /**
     * Gets the value of color.
     *
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Sets the value of color.
     *
     * @param mixed $color the color
     *
     * @return self
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Gets the value of transmission.
     *
     * @return mixed
     */
    public function getTransmission()
    {
        return $this->transmission;
    }

    /**
     * Sets the value of transmission.
     *
     * @param mixed $transmission the transmission
     *
     * @return self
     */
    public function setTransmission($transmission)
    {
        $this->transmission = $transmission;

        return $this;
    }

    /**
     * Gets the value of sold.
     *
     * @return mixed
     */
    public function getSold()
    {
        return $this->sold;
    }

    /**
     * Sets the value of sold.
     *
     * @param mixed $sold the sold
     *
     * @return self
     */
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
        $this->setBrand($model->getBrand());

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
     * Gets the value of fuelType.
     *
     * @return mixed
     */
    public function getFuelType()
    {
        return $this->fuelType;
    }

    /**
     * Sets the value of fuelType.
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

    /**
     * Gets the value of serviceId.
     *
     * @return mixed
     */
    public function getServiceId()
    {
        return $this->serviceId;
    }

    /**
     * Sets the value of serviceId.
     *
     * @param mixed $serviceId the service id
     *
     * @return self
     */
    public function setServiceId($serviceId)
    {
        $this->serviceId = $serviceId;

        return $this;
    }

    /**
     * Gets the value of vat.
     *
     * @return mixed
     */
    public function getVat()
    {
        return $this->vat;
    }

    /**
     * Sets the value of vat.
     *
     * @param mixed $vat the vat
     *
     * @return self
     */
    public function setVat($vat)
    {
        $this->vat = $vat;

        return $this;
    }

    public function getPhotos() 
    {
        return $this->photos;
    }

    public function setPhotos(Array $photos) 
    {
        $this->photos = $photos;

        return $this;
    }

    public function getDefaultPhoto(){
        foreach($this->getPhotos() as $photo){
            if($photo->getMain()){
                return $photo;
            }
        }
        
        return NULL;
    }

    /**
     * Gets the value of slug.
     *
     * @return mixed
     */
    public function getSlug()
    {
        return $this->slug;
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
    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Gets the value of hide.
     *
     * @return mixed
     */
    public function getHide()
    {
        return $this->hide;
    }

    /**
     * Sets the value of hide.
     *
     * @param mixed $hide the hide
     *
     * @return self
     */
    public function setHide($hide)
    {
        $this->hide = $hide;

        return $this;
    }

    /**
     * Gets the value of videoUrl.
     *
     * @return mixed
     */
    public function getVideoUrl()
    {
        return $this->videoUrl;
    }

    /**
     * Sets the value of videoUrl.
     *
     * @param mixed $videoUrl the video url
     *
     * @return self
     */
    public function setVideoUrl($videoUrl)
    {
        $this->videoUrl = $videoUrl;

        return $this;
    }

    /**
     * Gets the value of top.
     *
     * @return mixed
     */
    public function getTop()
    {
        return $this->top;
    }

    /**
     * Sets the value of top.
     *
     * @param mixed $top the top
     *
     * @return self
     */
    public function setTop($top)
    {
        $this->top = $top;

        return $this;
    }

    /**
     * Gets the value of homepage.
     *
     * @return mixed
     */
    public function getHomepage()
    {
        return $this->homepage;
    }

    /**
     * Sets the value of homepage.
     *
     * @param mixed $homepage the homepage
     *
     * @return self
     */
    public function setHomepage($homepage)
    {
        $this->homepage = $homepage;

        return $this;
    }

    /**
     * Gets the value of equipments.
     *
     * @return mixed
     */
    public function getEquipments()
    {
        return $this->equipments;
    }
}
