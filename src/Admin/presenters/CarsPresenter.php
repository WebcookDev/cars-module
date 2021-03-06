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
        //$grid->setDefaultSort(array('dateIn' ⇒ 'DESC'));

        $grid->addColumnText('fullname', 'Name')->setSortable();
        $grid->addColumnText('drivenKm', 'Driven')->setSortable();
        $grid->addColumnDate('dateOfManufacture', 'Date of manufacture')->setSortable();
        $grid->addColumnDate('dateIn', 'Date in')->setSortable();
        $grid->addColumnText('brand', 'Brand')->setCustomRender(function($item) {
            return $item->getModel()->getBrand()->getName();
        })->setSortable();
        $grid->addColumnText('model', 'Model')->setCustomRender(function($item) {
            return $item->getModel()->getName();
        })->setSortable();
        $grid->addColumnText('fuelType', 'Fuel type')->setCustomRender(function($item) {
            return $item->getFuelType()->getName();
        })->setSortable();
        $grid->addColumnText('condition', 'Condition')->setCustomRender(function($item) {
            return $item->getCondition()->getName();
        })->setSortable();
        $grid->addColumnText('top', 'Top')->setCustomRender(function($item) {
            return $item->getTop() ? 'yes' : 'no';
        })->setSortable();
        $grid->addColumnText('homepage', 'Added To homepage')->setCustomRender(function($item) {
            return $item->getHomepage() ? 'yes' : 'no';
        })->setSortable();

        $grid->setDefaultSort(array('dateIn' => 'DESC'));

        $grid->addActionHref("update", 'Edit', 'update', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-primary', 'ajax')));
        $grid->addActionHref("top", 'Top', 'top', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-primary', 'ajax')));
        $grid->addActionHref("addToHomepage", 'Add to homepage', 'addToHomepage', array('idPage' => $this->actualPage->getId()))->getElementPrototype()->addAttributes(array('class' => array('btn', 'btn-primary', 'ajax')));

        return $grid;
    }

    public function actionUpdate($id, $idPage)
    {
        $this->reloadContent();

        $this->car = $this->em->getRepository('\WebCMS\CarsModule\Entity\Car')->find($id);

        $this->template->idPage = $idPage;
    }

    public function actionTop($id, $idPage)
    {
        $topCar = $this->em->getRepository('\WebCMS\CarsModule\Entity\Car')->findOneBy(array(
            'top' => true
        ));
        if ($topCar) {
            $topCar->setTop(false);
        }

        $this->car = $this->em->getRepository('\WebCMS\CarsModule\Entity\Car')->find($id);
        $this->car->setTop(true);

        $this->em->flush();

        $this->flashMessage('Car has been set as top car', 'success');
        $this->forward('default', array(
            'idPage' => $this->actualPage->getId()
        ));
    }

    public function actionAddToHomepage($id, $idPage)
    {
        $this->car = $this->em->getRepository('\WebCMS\CarsModule\Entity\Car')->find($id);
        $this->car->setHomepage($this->car->getHomepage() ? false : true);

        $this->em->flush();

        $this->flashMessage('Car has been set as homepage car', 'success');
        $this->forward('default', array(
            'idPage' => $this->actualPage->getId()
        ));
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
            $this->flashMessage('Synchronization failed: ' . $e->getMessage(), 'danger', false);
        }
        
        $this->redirect('default', array(
            'idPage' => $this->actualPage->getId()
        ));   
    }
}