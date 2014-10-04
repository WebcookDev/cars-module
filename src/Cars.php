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
 * @author Tomas Voslar <tomas.voslar@webcook.cz>
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
    
    protected $searchable = true;

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
            'name' => 'Brands',
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
        $this->addBox('homepage', 'Cars', 'homepageBox');
        $this->addBox('brands', 'Cars', 'brandsBox');
    }

    public function search(\Doctrine\ORM\EntityManager $em, $phrase, \WebCMS\Entity\Language $language)
    {
        $query = $em->getRepository('WebCMS\CarsModule\Entity\Car')
                    ->createQueryBuilder('p')
                       ->where('p.name LIKE :search')
                       ->setParameter('search', '%' . $phrase . '%')
                       ->getQuery();
        $cars = $query->getResult();

        $page = $em->getRepository('WebCMS\Entity\Page')->findOneBy(array(
            'moduleName' => 'Cars',
            'presenter' => 'Cars'
        ));

        $results = array();
        $rate = 1;
        foreach ($cars as $car) {
            $url = ($language->getDefaultFrontend() ? '' : $language->getAbbr() . '/') . $page->getPath() . '/' . $car->getSlug();

            $result = new \WebCMS\SearchModule\SearchResult;
            $result->setTitle($car->getName() . ', ' . $car->getDateOfManufacture()->format('Y') . ', ' . \WebCMS\Helpers\SystemHelper::price($car->getPrice()));
            $result->setUrl($url);
            $result->setPerex('');
            $result->setRate($rate++);

            $results[] = $result;
        }

    return $results;
    }
}
