<?php

namespace WebCMS\CarsModule\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;

class CarRepository extends EntityRepository
{
	public function findPrevious($car)
	{
        $qb = $this->createQueryBuilder('c')
        	->select('c')
	        ->where('c.id < :id')
	        ->andWhere('c.hide = :hide')
	        ->setParameters(array('id' => $car->getId(), 'hide' => false))
	        ->orderBy('c.id', 'DESC')
	        ->setMaxResults(1);

		$previous = $qb->getQuery()->getOneOrNullResult();
        if (!$previous) {
            $previous = $this->findOneBy(array(
                'hide' => false
            ) ,array('id' => 'DESC'));    
        }

        return $previous;
	}

	public function findNext($car)
	{
		$qb = $this->createQueryBuilder('c');
        $qb->select('c')
	        ->where('c.id > :id')
	        ->andWhere('c.hide = :hide')
	        ->setParameters(array('id' => $car->getId(), 'hide' => false))
	        ->setMaxResults(1);

        $next = $qb->getQuery()->getOneOrNullResult();
        if (!$next) {
            $next = $this->findOneBy(array(
                'hide' => false
            ) ,array('id' => 'ASC'));    
        }

        return $next;
	}
}