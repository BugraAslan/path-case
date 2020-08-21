<?php

namespace App\Manager\Response;

use App\Model\Response\PaginationResponseModel;
use Knp\Component\Pager\Pagination\PaginationInterface;

class PaginationResponseManager
{
    /**
     * @param PaginationInterface $pagination
     * @return PaginationResponseModel
     */
    public function build(PaginationInterface $pagination)
    {
        $paginationResponse = new PaginationResponseModel();

        $page = $pagination->getCurrentPageNumber();
        $totalCount = $pagination->getTotalItemCount();
        $size = $pagination->getItemNumberPerPage();

        $totalPage = ceil($totalCount / $size);
        if (is_numeric($page) && $page > $totalPage){
            $page = $totalPage;
        }

        $paginationResponse
            ->setCount($totalCount)
            ->setLimit($size)
            ->setPage($page)
            ->setTotalPage($totalPage);

        return $paginationResponse;
    }
}