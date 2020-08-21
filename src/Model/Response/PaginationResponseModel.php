<?php

namespace App\Model\Response;

class PaginationResponseModel
{
    /** @var int */
    protected $page;

    /** @var int */
    protected $totalPage;

    /** @var int */
    protected $count;

    /** @var int */
    protected $limit;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return PaginationResponseModel
     */
    public function setPage(int $page): PaginationResponseModel
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getTotalPage(): int
    {
        return $this->totalPage;
    }

    /**
     * @param int $totalPage
     * @return PaginationResponseModel
     */
    public function setTotalPage(int $totalPage): PaginationResponseModel
    {
        $this->totalPage = $totalPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @param int $count
     * @return PaginationResponseModel
     */
    public function setCount(int $count): PaginationResponseModel
    {
        $this->count = $count;
        return $this;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @param int $limit
     * @return PaginationResponseModel
     */
    public function setLimit(int $limit): PaginationResponseModel
    {
        $this->limit = $limit;
        return $this;
    }
}