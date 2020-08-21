<?php

namespace App\Model\Request;

use JMS\Serializer\Annotation as Serializer;


/**
 * Class ShippingAddressRequestModel
 * @package App\Model\Request
 */
class ShippingAddressRequestModel
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    public $address;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    public $phone;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    public $district;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    public $city;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    public $email;

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return ShippingAddressRequestModel
     */
    public function setAddress(string $address): ShippingAddressRequestModel
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
     * @return ShippingAddressRequestModel
     */
    public function setPhone(string $phone): ShippingAddressRequestModel
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
     * @return ShippingAddressRequestModel
     */
    public function setDistrict(string $district): ShippingAddressRequestModel
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
     * @return ShippingAddressRequestModel
     */
    public function setCity(string $city): ShippingAddressRequestModel
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
     * @return ShippingAddressRequestModel
     */
    public function setEmail(string $email): ShippingAddressRequestModel
    {
        $this->email = $email;
        return $this;
    }
}