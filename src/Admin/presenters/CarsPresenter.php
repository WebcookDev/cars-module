<?php

/**
 * This file is part of the Cars module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace AdminModule\CarsModule;

use Nette\Forms\Form;
use WebCMS\CarsModule\Entity\Car;
use WebCMS\CarsModule\Entity\Brand;
use WebCMS\CarsModule\Entity\Model;
use WebCMS\CarsModule\Entity\Condition;
use WebCMS\CarsModule\Entity\FuelType;
use WebCMS\CarsModule\Common;
use WebCMS\CarsModule\Services;

/**
 * Main controller
 *
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 * @author Tomas Voslar <tomas.voslar@webcook.cz>
 */
class CarsPresenter extends BasePresenter
{
    private $car;

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

    public function renderDefault($idPage)
    {
        $this->reloadContent();
        $this->template->idPage = $idPage;
    }

    protected function createComponentGrid($name)
    {
        $grid = $this->createGrid($this, $name, "\WebCMS\CarsModule\Entity\Car");

        $grid->addColumnText('name', 'Name');
        $grid->addColumnText('drivenKm', 'Driven');
        $grid->addColumnDate('dateOfManufacture', 'Date');
        $grid->addColumnText('brand', 'Brand')->setCustomRender(function($item) {
            return $item->getModel()->getBrand()->getName();
        });
        $grid->addColumnText('model', 'Model')->setCustomRender(function($item) {
            return $item->getModel()->getName();
        });
        $grid->addColumnText('fuelType', 'Fuel type')->setCustomRender(function($item) {
            return $item->getFuelType()->getName();
        });
        $grid->addColumnText('condition', 'Condition')->setCustomRender(function($item) {
            return $item->getCondition()->getName();
        });

        $grid->addActionHref("update", 'Edit', 'update', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-primary', 'ajax')));

        return $grid;
    }

    public function actionUpdate($id, $idPage)
    {
        $this->reloadContent();

        $this->car = $this->em->getRepository('\WebCMS\CarsModule\Entity\Car')->find($id);

        $this->template->idPage = $idPage;
    }

    protected function createComponentCarForm()
    {
        $form = $this->createForm();
                
        $form->addText('videoUrl', 'Video URL');
        $form->addCheckbox('sold', 'Sold');
        $form->addCheckbox('hide', 'Hide');

        $form->addSubmit('submit', 'Save')->setAttribute('class', 'btn btn-success');
        $form->onSuccess[] = callback($this, 'carFormSubmitted');

        $form->setDefaults($this->car->toArray());
        
        return $form;
    }
    
    public function carFormSubmitted($form)
    {
        $values = $form->getValues();
        
        foreach ($values as $key => $value) {
            $setter = 'set' . ucfirst($key);
            $this->car->$setter($value);
        }

        $this->em->flush();
        $this->flashMessage('Car has been added/updated.', 'success');
        
        $this->forward('default', array(
            'idPage' => $this->actualPage->getId()
        ));
    }

    public function actionSynchronize()
    {
        $serviceType = $this->settings->get('service', 'carsModule')->getValue();

        try {
            $serviceFactory = new Common\ServiceFactory($serviceType, $this->em, $this->settings);
            $service = $serviceFactory->createService();    
            $service->synchronize();    
            
            $this->flashMessage('Data has been downloaded from the service point.', 'success');
        } catch (\Exception $e) {
            // log $e->getMessage()
            $this->flashMessage('Synchronization failed.', 'danger', false);
        }
        
        $this->redirect('default', array(
            'idPage' => $this->actualPage->getId()
        ));   
    }
}