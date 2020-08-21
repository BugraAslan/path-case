<?php

namespace App\Builder;

use App\Model\Request\OrderFilterRequestModel;

/**
 * Class Director
 * @package App\Builder
 */
class Director
{
    /** @var OrderFilterQueryBuilder */
    protected $orderFilterQueryBuilder;

    /**
     * Director constructor.
     * @param OrderFilterQueryBuilder $orderFilterQueryBuilder
     */
    public function __construct(OrderFilterQueryBuilder $orderFilterQueryBuilder)
    {
        $this->orderFilterQueryBuilder = $orderFilterQueryBuilder;
    }

    /**
     * @param OrderFilterRequestModel $orderFilterRequestModel
     * @param int $clientId
     * @return OrderFilterQueryBuilder
     */
    public function buildOrder(OrderFilterRequestModel $orderFilterRequestModel, int $clientId)
    {
        return $this->orderFilterQueryBuilder
            ->productId($orderFilterRequestModel->getProductId())
            ->orderCode($orderFilterRequestModel->getOrderCode())
            ->clientId($clientId)
            ->dateRange(
                $orderFilterRequestModel->getStartDate(),
                $orderFilterRequestModel->getEndDate()
            );
    }
}