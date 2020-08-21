<?php

namespace App\Service;

use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\Paginator;

class PaginationService
{
    /** @var Paginator */
    protected $paginator;

    /** @var int */
    private $maxSize = 200;

    public function setPaginator($paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * @param $query
     * @param int $page
     * @param int $size
     * @return PaginationInterface
     */
    public function setPagination($query, int $page, int $size)
    {
        if ($size > $this->maxSize){
            $size = $this->maxSize;
        }

        return $this->paginator->paginate($query, $page, $size);
    }
}