<?php

namespace App\Repository;

use App\Entity\OrderProduct;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method OrderProduct|null find($id, $lockMode = null, $lockVersion = null)
 * @method OrderProduct|null findOneBy(array $criteria, array $orderBy = null)
 * @method OrderProduct[]    findAll()
 * @method OrderProduct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrderProductRepository extends AbstractBaseServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderProduct::class);
    }

    /**
     * @param int $orderId
     * @param bool $enableResultCache
     * @param int $cacheLifeTime
     * @return int|mixed|string
     */
    public function findProductsByOrderId(
        int $orderId,
        bool $enableResultCache = false,
        int $cacheLifeTime = 0
    ) {
        $query = $this->createQueryBuilder('orderProduct')
            ->select('
                orderProduct.quantity,
                orderProduct.clientProductId, 
                product.name, 
                product.id, 
                product.price
            ')
            ->join(
                'App\Entity\Product',
                'product',
                'WITH',
                'product.id = orderProduct.productId'
            )
            ->where('orderProduct.orderId = :orderId')
            ->setParameter('orderId', $orderId)
            ->getQuery();

        if ($enableResultCache){
            $query->enableResultCache($cacheLifeTime);
        }

        return $query->getResult();
    }
}
