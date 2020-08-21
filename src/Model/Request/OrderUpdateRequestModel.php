<?php

namespace App\Model\Request;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class OrderUpdateRequestModel
{
    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\Length(min="3", max="55")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $orderCode;

    /**
     * @var string|null
     *
     * @Assert\Length(min="5")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $address;

    /**
     * @var string|null
     *
     * @Assert\Length(min="5", max="255")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $phone;

    /**
     * @var string|null
     *
     * @Assert\Length(min="2", max="255")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $district;

    /**
     * @var string|null
     *
     * @Assert\Length(min="2", max="255")
     * @Assert\Type("string")
     *
     * @Serializer\Type("string")
     */
    protected $city;

    /**
     * @var string|null
     *
     * @Assert\Length(min="7", max="255")
     * @Assert\Email()
     *
     * @Serializer\Type("string")
     */
    protected $email;

    /**
     * @return string
     */
    public function getOrderCode(): string
    {
        return $this->orderCode;
    }

    /**
     * @param string $orderCode
     * @return OrderUpdateRequestModel
     */
    public function setOrderCode(string $orderCode): OrderUpdateRequestModel
    {
        $this->orderCode = $orderCode;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getAddress(): ?string
    {
        return $this->address;
    }

    /**
     * @param string|null $address
     * @return OrderUpdateRequestModel
     */
    public function setAddress(?string $address): OrderUpdateRequestModel
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return OrderUpdateRequestModel
     */
    public function setPhone(?string $phone): OrderUpdateRequestModel
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDistrict(): ?string
    {
        return $this->district;
    }

    /**
     * @param string|null $district
     * @return OrderUpdateRequestModel
     */
    public function setDistrict(?string $district): OrderUpdateRequestModel
    {
        $this->district = $district;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string|null $city
     * @return OrderUpdateRequestModel
     */
    public function setCity(?string $city): OrderUpdateRequestModel
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return OrderUpdateRequestModel
     */
    public function setEmail(?string $email): OrderUpdateRequestModel
    {
        $this->email = $email;
        return $this;
    }
}