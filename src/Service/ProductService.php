<?php

namespace App\Service;

use App\Entity\Product;
use App\Model\Request\OrderCreateRequestModel;

class ProductService extends AbstractBaseService
{
    /**
     * @param OrderCreateRequestModel $orderCreateRequestModel
     * @return int|null
     */
    public function createProductByRequestModel(OrderCreateRequestModel $orderCreateRequestModel)
    {
        $productEntity = (new Product())
            ->setName($orderCreateRequestModel->getProductName())
            ->setPrice($orderCreateRequestModel->getProductPrice());

        $this->entityManager->persist($productEntity);
        $this->entityManager->flush();

        return $productEntity->getId();
    }
}