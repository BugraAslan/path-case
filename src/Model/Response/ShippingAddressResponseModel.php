<?php

namespace App\Model\Response;

use JMS\Serializer\Annotation as Serializer;

class ShippingAddressResponseModel
{
    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $address;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $phone;

    /**
     * @var string
     * @Serializer\Type("string")
     */
    protected $district;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $city;

    /**
     * @var string
     *
     * @Serializer\Type("string")
     */
    protected $email;

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @param string $address
     * @return ShippingAddressResponseModel
     */
    public function setAddress(string $address): ShippingAddressResponseModel
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
     * @return ShippingAddressResponseModel
     */
    public function setPhone(string $phone): ShippingAddressResponseModel
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
     * @return ShippingAddressResponseModel
     */
    public function setDistrict(string $district): ShippingAddressResponseModel
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
     * @return ShippingAddressResponseModel
     */
    public function setCity(string $city): ShippingAddressResponseModel
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
     * @return ShippingAddressResponseModel
     */
    public function setEmail(string $email): ShippingAddressResponseModel
    {
        $this->email = $email;
        return $this;
    }
}