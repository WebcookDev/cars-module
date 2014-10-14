<?php

/**
 * This file is part of the Cars module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace AdminModule\CarsModule;

use WebCMS\CarsModule\Services;

/**
 * Description of 
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 */
class SettingsPresenter extends BasePresenter
{	
    protected function startup()
    {
		parent::startup();
    }

    protected function beforeRender()
    {
		parent::beforeRender();	
    }
	
    public function actionDefault($idPage)
    {
    }
	
    public function createComponentSettingsForm()
    {
		$settings = array();

        $settings[] = $this->settings->get('Cars per page', 'carsModule' . $this->actualPage->getId(), 'text');

        $settings[] = $this->settings->get('service', 'carsModule', 'select', array(
            Services\TipCarsService::getServiceName() => 'Tip cars'
        ));
        $settings[] = $this->settings->get('Tipcars username', 'carsModule', 'text');
        $settings[] = $this->settings->get('Tipcars service id', 'carsModule', 'text');

		return $this->createSettingsForm($settings);
    }
	
    public function renderDefault($idPage)
    {
		$this->reloadContent();

		$this->template->idPage = $idPage;
    }
}