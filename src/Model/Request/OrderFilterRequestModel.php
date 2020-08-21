<?php

namespace App\Model\Request;

use DateTime;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class OrderFilterRequestModel extends PaginationRequestModel
{
    /**
     * @var string|null
     *
     * @Serializer\Type("string")
     */
    protected $orderCode;

    /**
     * @var DateTime|null
     *
     * @Assert\DateTime()
     *
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    protected $startDate;

    /**
     * @var DateTime|null
     *
     * @Assert\DateTime()
     *
     * @Serializer\Type("DateTime<'Y-m-d H:i:s'>")
     */
    protected $endDate;

    /**
     * @var string|null
     *
     * @Assert\Length(min="3", max="55")
     *
     * @Serializer\Type("string")
     */
    protected $productId;

    /**
     * @return string|null
     */
    public function getOrderCode(): ?string
    {
        return $this->orderCode;
    }

    /**
     * @param string|null $orderCode
     * @return OrderFilterRequestModel
     */
    public function setOrderCode(?string $orderCode): OrderFilterRequestModel
    {
        $this->orderCode = $orderCode;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getStartDate(): ?DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime|null $startDate
     * @return OrderFilterRequestModel
     */
    public function setStartDate(?DateTime $startDate): OrderFilterRequestModel
    {
        $this->startDate = $startDate;
        return $this;
    }

    /**
     * @return DateTime|null
     */
    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime|null $endDate
     * @return OrderFilterRequestModel
     */
    public function setEndDate(?DateTime $endDate): OrderFilterRequestModel
    {
        $this->endDate = $endDate;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProductId(): ?string
    {
        return $this->productId;
    }

    /**
     * @param string|null $productId
     * @return OrderFilterRequestModel
     */
    public function setProductId(?string $productId): OrderFilterRequestModel
    {
        $this->productId = $productId;
        return $this;
    }
}