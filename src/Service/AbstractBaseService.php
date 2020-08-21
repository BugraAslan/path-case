<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

abstract class AbstractBaseService
{
    /** @var EntityManagerInterface */
    protected $entityManager;

    /** @var PaginationService */
    protected $paginationService;

    /**
     * @required
     * @param EntityManagerInterface $entityManager
     * @param PaginationService $paginationService
     */
    public function setBaseServiceArguments(
        EntityManagerInterface $entityManager,
        PaginationService $paginationService
    ) {
        $this->entityManager = $entityManager;
        $this->paginationService = $paginationService;
    }
}