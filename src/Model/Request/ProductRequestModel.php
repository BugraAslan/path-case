<?php

namespace App\Model\Request;

use JMS\Serializer\Annotation as Serializer;

/**
 * Class ProductRequestModel
 * @package App\Model\Request
 */
class ProductRequestModel
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
     * @return ProductRequestModel
     */
    public function setProductId(string $productId): ProductRequestModel
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
     * @return ProductRequestModel
     */
    public function setProductName(string $productName): ProductRequestModel
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
     * @return ProductRequestModel
     */
    public function setProductPrice(float $productPrice): ProductRequestModel
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
     * @return ProductRequestModel
     */
    public function setQuantity(int $quantity): ProductRequestModel
    {
        $this->quantity = $quantity;
        return $this;
    }
}