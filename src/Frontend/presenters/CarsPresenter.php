<?php

/**
 * This file is part of the Cars module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace FrontendModule\CarsModule;

use WebCMS\CarsModule\Entity\Car;

/**
 * Description of CarsPresenter
 *
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 */
class CarsPresenter extends BasePresenter
{
	private $id;
	
	protected function startup() 
    {
		parent::startup();
	}

	protected function beforeRender()
    {
		parent::beforeRender();	
	}


	public function actionDefault($id)
    {	
    	
	}

	public function renderDefault($id)
    {	
		$this->template->id = $id;
	}
}
