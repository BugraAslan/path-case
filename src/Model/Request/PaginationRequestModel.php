<?php

namespace App\Model\Request;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

class PaginationRequestModel
{
    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\GreaterThan(0)
     * @Assert\Type("integer")
     *
     * @Serializer\Type("integer")
     */
    protected $page;

    /**
     * @var integer
     *
     * @Assert\NotBlank()
     * @Assert\NotNull()
     * @Assert\GreaterThan(0)
     * @Assert\Type("integer")
     *
     * @Serializer\Type("integer")
     */
    protected $size;

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     * @return PaginationRequestModel
     */
    public function setPage(int $page): PaginationRequestModel
    {
        $this->page = $page;
        return $this;
    }

    /**
     * @return int
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * @param int $size
     * @return PaginationRequestModel
     */
    public function setSize(int $size): PaginationRequestModel
    {
        $this->size = $size;
        return $this;
    }
}