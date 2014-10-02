<?php

/**
 * This file is part of the Cars module for webcms2.
 * Copyright (c) @see LICENSE
 */

namespace AdminModule\CarsModule;

use Nette\Forms\Form;
use WebCMS\CarsModule\Entity\Car;

/**
 * Description of
 *
 * @author Jakub Sanda <jakub.sanda@webcook.cz>
 */
class CarsPresenter extends BasePresenter
{
    private $investment;

    protected function startup()
    {
    	parent::startup();
    }

    protected function beforeRender()
    {
	   parent::beforeRender();
    }

    protected function createComponentGrid($name)
    {
        $grid = $this->createGrid($this, $name, "\WebCMS\CarsModule\Entity\Car");

        $grid->addColumnNumber('id', 'Car id')->setSortable();
        $grid->addColumnText('name', 'Name')->setCustomRender(function($item) {
            return $item->getName();
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

    public function actionDefault($idPage)
    {

    }

    public function renderDefault($idPage)
    {
    	$this->reloadContent();
    	$this->template->idPage = $idPage;
    }
}