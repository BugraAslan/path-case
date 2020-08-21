<?php

namespace App\Model\Response;

use JMS\Serializer\Annotation as Serializer;

class ProductResponseModel
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $productId;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $productName;

    /**
     * @var float
     *
     * @Serializer\Type("float")
     */
    protected $productPrice;

    /**
     * @var integer
     *
     * @Serializer\Type("integer")
     */
    protected $quantity;

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     * @return ProductResponseModel
     */
    public function setProductId(string $productId): ProductResponseModel
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     * @return ProductResponseModel
     */
    public function setProductName(string $productName): ProductResponseModel
    {
        $this->productName = $productName;
        return $this;
    }

    /**
     * @return float
     */
    public function getProductPrice(): float
    {
        return $this->productPrice;
    }

    /**
     * @param float $productPrice
     * @return ProductResponseModel
     */
    public function setProductPrice(float $productPrice): ProductResponseModel
    {
        $this->productPrice = $productPrice;
        return $this;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     * @return ProductResponseModel
     */
    public function setQuantity(int $quantity): ProductResponseModel
    {
        $this->quantity = $quantity;
        return $this;
    }
}