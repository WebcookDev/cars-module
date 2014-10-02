<?php

namespace WebCMS\CarsModule\Services;

use WebCMS\CarsModule\Common;
use WebCMS\CarsModule\Entity\Car;
use WebCMS\CarsModule\Entity\Model;
use WebCMS\CarsModule\Entity\Brand;
use WebCMS\CarsModule\Entity\Condition;
use WebCMS\CarsModule\Entity\FuelType;

class TipCarsService extends Common\AbstractXmlServiceParser
{
	public static function getServiceName()
	{
		return 'tipCarsService';
	}

	public function assembleUrl()
	{
		$username = $this->settings->get('Tipcars username', 'carsModule')->getValue();
		$serviceId = $this->settings->get('Tipcars service id', 'carsModule')->getValue();

		if (!empty($username) && !empty($serviceId)) {
			return "http://export.tipcars.com/inzerce_xml.php?R=$username&F=$serviceId&T=N&Z=N&V=N";	
		} else {
			throw new \Exception('Tipcars parameters not given.');
		}
	}

	public function parseData($data)
	{
		$cars = $data->firma->cars;

		foreach ($cars->car as $car) {
			$exists = $this->em->getRepository('WebCMS\CarsModule\Entity\Car')->findOneByServiceId($this->getObjectValue($car->custom_car_id));

			if ($exists) {
				$carEntity = $exists;
			} else {
				$carEntity = new Car;
				$carEntity->setServiceId($this->getObjectValue($car->custom_car_id));

				$this->em->persist($carEntity);
			}

			$carEntity->setName($this->getObjectValue($car->manufacturer_text) . ' ' . $this->getObjectValue($car->model_text));

			$model = $this->saveOrGetObject('Model', $this->getObjectValue($car->model_text));
			$model->setBrand($this->saveOrGetObject('Brand', $this->getObjectValue($car->manufacturer_text)));

			$carEntity->setModel($model);
			$carEntity->setCondition($this->saveOrGetObject('Condition', $this->getObjectValue($car->condition_text)));
			$carEntity->setFuelType($this->saveOrGetObject('FuelType', $this->getObjectValue($car->fuel_text)));
			$carEntity->setDrivenKm($this->getObjectValue($car->tachometr));
			$carEntity->setPrice($this->getObjectValue($car->price));
			$carEntity->setVat($this->getObjectValue($car->vat));
			$carEntity->setEngineVolume($this->getObjectValue($car->engine_volume));
			$carEntity->setEnginePower($this->getObjectValue($car->engine_power));
			$carEntity->setShortInfo($this->getObjectValue($car->note));
			$carEntity->setBodyWork($this->getObjectValue($car->body_text));
			$carEntity->setColor($this->getObjectValue($car->color_text));
			//$carEntity->setTransmission();

			preg_match('/(\d{4})(\d{2})/', $this->getObjectValue($car->made_date), $date);
			$carEntity->setDateOfManufacture(new \DateTime($date[1] . '-' . $date[2] . '-1'));
		}

		$this->em->flush();

		return $data;
	}

	private function saveOrGetObject($object, $value)
	{
		$object = "WebCMS\\CarsModule\\Entity\\$object";
		$repository = $this->em->getRepository($object);
		$exists = $repository->findOneByName($value);

		if ($exists) {
			return $exists;
		} else {
			$newObject = new $object;
			$newObject->setName($value);

			$this->em->persist($newObject);
			$this->em->flush();

			return $newObject;
		}
	}

	public function getObjectValue($object)
	{
		return (string) $object;
	}
}