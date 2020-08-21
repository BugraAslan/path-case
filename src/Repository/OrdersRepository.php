<?php

namespace App\Repository;

use App\Builder\OrderFilterQueryBuilder;
use App\Entity\Orders;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\Query;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Orders|null find($id, $lockMode = null, $lockVersion = null)
 * @method Orders|null findOneBy(array $criteria, array $orderBy = null)
 * @method Orders[]    findAll()
 * @method Orders[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrdersRepository extends AbstractBaseServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Orders::class);
    }

    public function abc()
    {
        return $this->createQueryBuilder('orders')
            ->addSelect('client')
            ->leftJoin('orders.clientId', 'client')
            ->where('orders.clientId = 1')
            ->getQuery()->getResult();
    }

    /**
     * @param int $clientId
     * @return Query
     */
    public function findOrdersQueryByClientId(int $clientId)
    {
        return $this->createQueryBuilder('orders')
            ->where('orders.clientId = :clientId')
            ->setParameter('clientId', $clientId)
            ->getQuery();
    }

    /**
     * @param OrderFilterQueryBuilder $orderFilterQueryBuilder
     * @return Query
     */
    public function getOrderFilterQueryByQueryBuilder(OrderFilterQueryBuilder $orderFilterQueryBuilder)
    {
        return $orderFilterQueryBuilder->getQueryBuilder()->getQuery();
    }

    /**
     * @param string $orderCode
     * @param int $clientId
     * @param bool $enableResultCache
     * @param int $cacheLifeTime
     * @return Orders|null
     */
    public function findOrderByOrderCode(
        string $orderCode,
        int $clientId,
        bool $enableResultCache = false,
        int $cacheLifeTime = 0
    ) {
        $query = $this->createQueryBuilder('orders')
            ->where('orders.orderCode = :orderCode')
            ->andWhere('orders.clientId = :clientId')
            ->setParameters([
                'orderCode' => $orderCode,
                'clientId' => $clientId
            ])
            ->getQuery();

        if ($enableResultCache){
            $query->enableResultCache($cacheLifeTime);
        }

        try {
            return $query->getOneOrNullResult();
        } catch (NonUniqueResultException $e) {
            return null;
        }
    }
}
