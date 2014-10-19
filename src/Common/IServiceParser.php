<?php

namespace WebCMS\CarsModule\Common;

interface IServiceParser
{
	static function getServiceName();

	function assembleUrl();

	function parseData($data);

	function needUpdate();
}