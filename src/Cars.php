<?php

/**
 * This file is part of the Cars module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace WebCMS\CarsModule;

/**
 * Description of cars
 *
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 */
class Cars extends \WebCMS\Module
{
	/**
	 * [$name description]
	 * @var string
	 */
    protected $name = 'Cars';
    
    /**
     * [$author description]
     * @var string
     */
    protected $author = 'Jakub Sanda';
    
    /**
     * [$presenters description]
     * @var array
     */
    protected $presenters = array(
		array(
		    'name' => 'Cars',
		    'frontend' => true,
		    'parameters' => true
		),
		array(
		    'name' => 'Settings',
		    'frontend' => false
		)
    );

    public function __construct() 
    {
	
    }
}
