<?php

namespace App\Service;

use App\Entity\OrderProduct;
use App\Entity\Product;
use App\Repository\OrderProductRepository;

class OrderProductService extends AbstractBaseService
{
    /** @var OrderProductRepository */
    protected $orderProductRepository;

    /**
     * OrderProductService constructor.
     * @param OrderProductRepository $orderProductRepository
     */
    public function __construct(OrderProductRepository $orderProductRepository)
    {
        $this->orderProductRepository = $orderProductRepository;
    }

    /**
     * @param int $orderId
     * @param int $productId
     * @param int $quantity
     * @param string $clientProductId
     * @return int|null
     */
    public function createOrderProduct(
        int $orderId,
        int $productId,
        int $quantity,
        string $clientProductId
    ) {
        $orderProductEntity = (new OrderProduct())
            ->setOrderId($orderId)
            ->setProductId($productId)
            ->setQuantity($quantity)
            ->setClientProductId($clientProductId);

        $this->entityManager->persist($orderProductEntity);
        $this->entityManager->flush();

        return $orderProductEntity->getId();
    }

    /**
     * @param int $orderId
     * @return Product[]
     */
    public function getProductsByOrderId(int $orderId)
    {
        return $this->orderProductRepository->findProductsByOrderId(
            $orderId,
            true,
            3600
        );
    }
}