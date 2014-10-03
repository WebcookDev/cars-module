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
    private $repository;
    
    private $car;

    private $cars;
    
    protected function startup() 
    {
        parent::startup();

        $this->repository = $this->em->getRepository('WebCMS\CarsModule\Entity\Car');
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
        $this->cars = $this->repository->findAll(array('id' => 'DESC'));

        $this->template->cars = $this->cars;
        $this->template->id = $id;
    }
}
