<?php

namespace App\Model\Request;

use App\Validator\Constraints\ShippingDate;
use DateTime;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class OrderCreateRequestModel
 * @package App\Model\Request
 */
class OrderCreateRequestModel
{
    /**
     * @var string
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(min="5", max="55")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $orderCode;

    /**
     * @var DateTime
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\DateTime()
     * @ShippingDate()
     *
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    protected $shippingDate;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min="5")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $address;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min="5", max="255")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $phone;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min="2", max="255")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $district;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min="2", max="255")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $city;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min="7", max="255")
     * @Assert\Email()
     *
     * @Serializer\Type("string")
     */
    protected $email;

    /**
     * @var string
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $productId;

    /**
     * @var string
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\Length(min="5", max="255")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $productName;

    /**
     * @var float
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     * @Assert\Type("float")
     *
     * @Serializer\Type("float")
     */
    protected $productPrice;

    /**
     * @var integer
     *
     * @Assert\NotNull()
     * @Assert\NotBlank()
     * @Assert\GreaterThan(0)
     * @Assert\Type("integer")
     *
     * @Serializer\Type("integer")
     */
    protected $quantity;

    /**
     * @return string
     */
    public function getOrderCode(): string
    {
        return $this->orderCode;
    }

    /**
     * @param string $orderCode
     * @return OrderCreateRequestModel
     */
    public function setOrderCode(string $orderCode): OrderCreateRequestModel
    {
        $this->orderCode = $orderCode;
        return $this;
    }

    /**
     * @return ProductRequestModel[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @param ProductRequestModel[] $products
     * @return OrderCreateRequestModel
     */
    public function setProducts(array $products): OrderCreateRequestModel
    {
        $this->products = $products;
        return $this;
    }

    /**
     * @return ShippingAddressRequestModel[]
     */
    public function getShippingAddress(): array
    {
        return $this->shippingAddress;
    }

    /**
     * @param ShippingAddressRequestModel[] $shippingAddress
     * @return OrderCreateRequestModel
     */
    public function setShippingAddress(array $shippingAddress): OrderCreateRequestModel
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    /**
     * @return DateTime
     */
    public function getShippingDate(): DateTime
    {
        return $this->shippingDate;
    }

    /**
     * @param DateTime $shippingDate
     * @return OrderCreateRequestModel
     */
    public function setShippingDate(DateTime $shippingDate): OrderCreateRequestModel
    {
        $this->shippingDate = $shippingDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return OrderCreateRequestModel
     */
    public function setAddress(string $address): OrderCreateRequestModel
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     * @return OrderCreateRequestModel
     */
    public function setPhone(string $phone): OrderCreateRequestModel
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string
     */
    public function getDistrict(): string
    {
        return $this->district;
    }

    /**
     * @param string $district
     * @return OrderCreateRequestModel
     */
    public function setDistrict(string $district): OrderCreateRequestModel
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return OrderCreateRequestModel
     */
    public function setCity(string $city): OrderCreateRequestModel
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return OrderCreateRequestModel
     */
    public function setEmail(string $email): OrderCreateRequestModel
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     * @return OrderCreateRequestModel
     */
    public function setProductId(string $productId): OrderCreateRequestModel
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
     * @return OrderCreateRequestModel
     */
    public function setProductName(string $productName): OrderCreateRequestModel
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
     * @return OrderCreateRequestModel
     */
    public function setProductPrice(float $productPrice): OrderCreateRequestModel
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
     * @return OrderCreateRequestModel
     */
    public function setQuantity(int $quantity): OrderCreateRequestModel
    {
        $this->quantity = $quantity;
        return $this;
    }
}