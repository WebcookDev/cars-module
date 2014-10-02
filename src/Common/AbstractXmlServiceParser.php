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

	private function XmlToArray($xmlData)
	{
		return simplexml_load_string($xmlData);
	}

	public function synchronize()
	{
		$client = new Client();
		$response = $client->get($this->assembleUrl())->send();

		if ($response->getStatusCode() === 200) {
			return $this->parseData($this->xmlToArray($response->getBody()));
		} else {
			throw new \Exception('Wrong request.');
		}
	}
}