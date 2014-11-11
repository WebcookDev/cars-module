<?php

namespace WebCMS\CarsModule\Common;

use Guzzle\Http\Client;

abstract class AbstractXmlServiceParser implements IServiceParser
{
	protected $em;

	protected $settings;

	public function __construct($em, $settings)
	{
		$this->em = $em;
		$this->settings = $settings;
	}

	protected function XmlToArray($xmlData, $withoutGzip = false)
	{
		if ($this->settings->get('Enable Gzip', 'carsModule', 'checkbox')->getValue() && $withoutGzip === false) {

			return simplexml_load_string(gzdecode($xmlData));

		} else {

			return simplexml_load_string($xmlData);

		}
		
	}

	public function synchronize()
	{
		if (!$this->needUpdate()) {
            throw new \Exception('Nothing changed from last update.');
        }
        
		$response = $this->makeRequest($this->assembleUrl());

		return $this->parseData($this->xmlToArray($response));
	}

	public function makeRequest($url)
	{
		$client = new Client();
		$response = $client->get($url)->send();

		if ($response->getStatusCode() === 200) {
			return $response->getBody();
		} else {
			throw new \Exception('Wrong request.');
		}
	}
}