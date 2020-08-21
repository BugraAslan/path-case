<?php

namespace App\Manager\Response;

use App\Entity\Orders;
use App\Entity\Product;
use App\Model\Response\OrderListResponseModel;
use App\Model\Response\ProductResponseModel;
use App\Model\Response\ShippingAddressResponseModel;
use Doctrine\Common\Collections\ArrayCollection;

class OrderResponseManager
{
    /**
     * @param Orders $order
     * @param array $products
     * @return OrderListResponseModel
     */
    public function buildOrder(Orders $order, array $products)
    {
        return (new OrderListResponseModel())
            ->setCreatedDate($order->getCreatedDate()->format('Y-m-d H:i:s'))
            ->setShippingDate($order->getShippingDate()->format('Y-m-d H:i:s'))
            ->setTotalPrice($order->getTotalPrice())
            ->setOrderCode($order->getOrderCode())
            ->setProducts($this->buildOrderProduct($products))
            ->setShippingAddress($this->buildOrderShippingAddress($order));
    }

    /**
     * @param Orders $order
     * @return array
     */
    public function buildOrderShippingAddress(Orders $order)
    {
        $shippingAddressCollection = new ArrayCollection();

        $shippingAddressCollection->add(
            (new ShippingAddressResponseModel())
                ->setPhone($order->getPhone())
                ->setEmail($order->getEmail())
                ->setDistrict($order->getDistrict())
                ->setCity($order->getCity())
                ->setAddress($order->getAddress())
        );

        return $shippingAddressCollection->toArray();
    }

    /**
     * @param Product[] $products
     * @return array
     */
    public function buildOrderProduct(array $products)
    {
        $productCollection = new ArrayCollection();

        foreach ($products as $product){
            $productCollection->add(
                (new ProductResponseModel())
                    ->setQuantity($product['quantity'])
                    ->setProductId($product['clientProductId'])
                    ->setProductName($product['name'])
                    ->setProductPrice($product['price'])
            );
        }

        return $productCollection->toArray();
    }
}