<?php

namespace App\Model\Response;

use JMS\Serializer\Annotation as Serializer;

class OrderListResponseModel
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $orderCode;

    /**
     * @var float
     *
     * @Serializer\Type("float")
     */
    protected $totalPrice;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $createdDate;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $shippingDate;

    /**
     * @var ProductResponseModel[]
     *
     * @Serializer\Type("array<App\Model\Response\ProductResponseModel>")
     */
    protected $products;

    /**
     * @var ShippingAddressResponseModel[]
     *
     * @Serializer\Type("array<App\Model\Response\ShippingAddressResponseModel>")
     */
    protected $shippingAddress;

    /**
     * @return string
     */
    public function getOrderCode(): string
    {
        return $this->orderCode;
    }

    /**
     * @param string $orderCode
     * @return OrderListResponseModel
     */
    public function setOrderCode(string $orderCode): OrderListResponseModel
    {
        $this->orderCode = $orderCode;
        return $this;
    }

    /**
     * @return float
     */
    public function getTotalPrice(): float
    {
        return $this->totalPrice;
    }

    /**
     * @param float $totalPrice
     * @return OrderListResponseModel
     */
    public function setTotalPrice(float $totalPrice): OrderListResponseModel
    {
        $this->totalPrice = $totalPrice;
        return $this;
    }

    /**
     * @return string
     */
    public function getCreatedDate(): string
    {
        return $this->createdDate;
    }

    /**
     * @param string $createdDate
     * @return OrderListResponseModel
     */
    public function setCreatedDate(string $createdDate): OrderListResponseModel
    {
        $this->createdDate = $createdDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getShippingDate(): string
    {
        return $this->shippingDate;
    }

    /**
     * @param string $shippingDate
     * @return OrderListResponseModel
     */
    public function setShippingDate(string $shippingDate): OrderListResponseModel
    {
        $this->shippingDate = $shippingDate;
        return $this;
    }

    /**
     * @return ProductResponseModel[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param ProductResponseModel[] $products
     * @return OrderListResponseModel
     */
    public function setProducts(array $products): OrderListResponseModel
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return ShippingAddressResponseModel[]
     */
    public function getShippingAddress(): array
    {
        return $this->shippingAddress;
    }

    /**
     * @param ShippingAddressResponseModel[] $shippingAddress
     * @return OrderListResponseModel
     */
    public function setShippingAddress(array $shippingAddress): OrderListResponseModel
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }
}