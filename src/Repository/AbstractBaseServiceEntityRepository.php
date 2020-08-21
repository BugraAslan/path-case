<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;

abstract class AbstractBaseServiceEntityRepository extends ServiceEntityRepository
{
    /**
     * @param $object
     * @throws OptimisticLockException|ORMException
     */
    public function save($object)
    {
        $this->getEntityManager()->persist($object);
        $this->getEntityManager()->flush($object);
    }
}