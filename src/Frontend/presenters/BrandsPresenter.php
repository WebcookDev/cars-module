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
 * @author Tomas Voslar <tomas.voslar@webcook.cz>
 */
class BrandsPresenter extends BasePresenter
{
    private $repository;

    private $brandRepository;

    private $cars = array();
    
    protected function startup() 
    {
        parent::startup();

        $this->repository = $this->em->getRepository('WebCMS\CarsModule\Entity\Car');
        $this->brandRepository = $this->em->getRepository('WebCMS\CarsModule\Entity\Brand');
    }

    protected function beforeRender()
    {
        parent::beforeRender(); 
    }


    public function actionDefault($id)
    {   
        $parameters = $this->getParameter();
        if (count($parameters['parameters']) > 0) {
            $brandSlug = $parameters['parameters'][0];
            $brand = $this->brandRepository->findOneBySlug($brandSlug);

            $this->cars = $this->repository->findByBrand($brand);
        }
    }

    public function renderDefault($id)
    {           
        $this->template->carPage = $this->em->getRepository('WebCMS\Entity\Page')->findOneBy(array(
            'moduleName' => 'Cars',
            'presenter' => 'Cars'
        ));
        $this->template->cars = $this->cars;
        $this->template->id = $id;
    }
}