<?php

/**
 * This file is part of the Cars module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace WebCMS\CarsModule\Common;

use WebCMS\CarsModule\Services;

class ServiceFactory
{
	private $em;

	private $settings;

	private $serviceName;

	public function __construct($serviceName, $em, $settings)
	{
		$this->serviceName = $serviceName;
		$this->em = $em;
		$this->settings = $settings;
	}

	public function createService()
	{
		switch ($this->serviceName) {
			case Services\TipCarsService::getServiceName():
				return new Services\TipCarsService($this->em, $this->settings);
				break;
			default:
				
				break;
		}
	}
}