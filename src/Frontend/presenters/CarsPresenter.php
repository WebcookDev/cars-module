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
        $parameters = $this->getParameter();
        if (count($parameters['parameters']) > 0) {
            $slug = $parameters['parameters'][0];
            $this->car = $this->repository->findOneBySlug($slug);
        }
    }

    public function renderDefault($id)
    {   
        if ($this->car) {
            $this->template->car = $this->car;
            $this->template->setFile(APP_DIR . '/templates/cars-module/Cars/detail.latte');
        } else {
            $this->cars = $this->repository->findAll(array('id' => 'DESC'));    
        }
        
        $this->template->cars = $this->cars;
        $this->template->id = $id;
    }

    public function homepageBox($context)
    {
        $template = $context->createTemplate();
        $template->cars = $context->em->getRepository('WebCMS\CarsModule\Entity\Car')->findAll(array('id' => 'DESC'));
        $template->setFile(APP_DIR . '/templates/cars-module/Cars/homepageBox.latte');

        return $template;  
    }
}
