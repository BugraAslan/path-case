<?php

namespace App\Builder;

use App\Repository\OrdersRepository;
use DateTime;
use Doctrine\ORM\QueryBuilder;

/**
 * Class OrderFilterQueryBuilder
 * @package App\Builder
 */
class OrderFilterQueryBuilder
{
    /** @var QueryBuilder */
    protected $queryBuilder;

    /** @var OrdersRepository */
    protected $orderRepository;

    /**
     * OrderFilterQueryBuilder constructor.
     * @param OrdersRepository $orderRepository
     */
    public function __construct(OrdersRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->reset();
    }

    /**
     * @param DateTime|null $startDate
     * @param DateTime|null $endDate
     * @return OrderFilterQueryBuilder
     */
    public function dateRange(?DateTime $startDate, ?DateTime $endDate)
    {
        if ($startDate && $endDate && !$startDate->diff($endDate)->invert){
            $this->queryBuilder
                ->andWhere('orders.createdDate BETWEEN :startDate AND :endDate')
                ->setParameter('startDate', $startDate)
                ->setParameter('endDate', $endDate);
        }

        return $this;
    }

    /**
     * @param string|null $orderCode
     * @return $this
     */
    public function orderCode(?string $orderCode)
    {
        if ($orderCode){
            $this->queryBuilder
                ->andWhere('orders.orderCode = :orderCode')
                ->setParameter('orderCode', $orderCode);
        }

        return $this;
    }

    /**
     * @param string|null $productId
     * @return $this
     */
    public function productId(?string $productId)
    {
        if ($productId){
            $this->queryBuilder
                ->leftJoin(
                    'App\Entity\OrderProduct',
                    'orderProduct',
                    'WITH',
                    'orderProduct.orderId = orders.id'
                )
                ->andWhere('orderProduct.clientProductId = :clientProductId')
                ->setParameter('clientProductId', $productId);
        }

        return $this;
    }

    /**
     * @param int $clientId
     * @return $this
     */
    public function clientId(int $clientId)
    {
        $this->queryBuilder
            ->andWhere('orders.clientId = :clientId')
            ->setParameter('clientId', $clientId);

        return $this;
    }

    public function reset()
    {
        $this->queryBuilder = $this->orderRepository->createQueryBuilder('orders');
    }

    /**
     * @return QueryBuilder
     */
    public function getQueryBuilder()
    {
        $result = $this->queryBuilder;
        $this->reset();

        return $result;
    }
}