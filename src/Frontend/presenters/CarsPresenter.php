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
            $this->car = $this->repository->findOneBy(array(
                'slug' => $slug,
                'hide' => false
            ));
        }
    }

    public function renderDefault($id)
    {   
        if ($this->car) {
            $this->template->car = $this->car;
            $this->template->similarCount = count($this->repository->findBy(array(
                'brand' => $this->car->getBrand(),
                'hide' => false
            ))) -1;

            $this->template->carPrev = $this->repository->findPrevious($this->car);
            $this->template->carNext = $this->repository->findNext($this->car);
            $this->template->setFile(APP_DIR . '/templates/cars-module/Cars/detail.latte');
        } else {
            $this->cars = $this->repository->findBy(array(
                'hide' => false
            ) ,array('id' => 'DESC'));    
        }
        
        $this->template->brandPage = $this->em->getRepository('WebCMS\Entity\Page')->findOneBy(array(
            'moduleName' => 'Cars',
            'presenter' => 'Brands'
        ));

        $this->template->cars = $this->cars;
        $this->template->id = $id;
    }

    public function homepageBox($context)
    {
        $template = $context->createTemplate();
        $template->cars = $context->em->getRepository('WebCMS\CarsModule\Entity\Car')->findBy(array(
            'hide' => false
        ), array('id' => 'DESC'));
        $template->carPage = $context->em->getRepository('WebCMS\Entity\Page')->findOneBy(array(
            'moduleName' => 'Cars',
            'presenter' => 'Cars'
        ));
        $template->abbr = $context->abbr;
        $template->setFile(APP_DIR . '/templates/cars-module/Cars/homepageBox.latte');

        return $template;  
    }

    public function brandsBox($context)
    {
        $template = $context->createTemplate();
        $template->brands = $context->em->getRepository('WebCMS\CarsModule\Entity\Brand')->findAll(array(
            'hide' => false
        ));
        $template->brandPage = $context->em->getRepository('WebCMS\Entity\Page')->findOneBy(array(
            'moduleName' => 'Cars',
            'presenter' => 'Brands'
        ));
        $template->abbr = $context->abbr;
        $template->setFile(APP_DIR . '/templates/cars-module/Brands/brandsBox.latte');

        return $template;
    }

}
