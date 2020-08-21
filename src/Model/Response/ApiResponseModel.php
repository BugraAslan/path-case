<?php

namespace App\Model\Response;

use Symfony\Component\HttpFoundation\Response;

class ApiResponseModel
{
    /** @var boolean */
    protected $success;

    /** @var object|array|null */
    protected $data;

    /** @var object|array|null */
    protected $errors;

    /** @var int */
    protected $statusCode;

    /**
     * CmsResponse constructor.
     * @param bool $isSuccess
     * @param $data
     * @param $errors
     * @param int $statusCode
     */
    public function __construct(
        bool $isSuccess,
        $data,
        $errors = null,
        int $statusCode = Response::HTTP_OK
    ) {
        $this->success = $isSuccess;
        $this->data = $data;
        $this->errors = $errors;
        $this->statusCode = $statusCode;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->success;
    }

    /**
     * @return array|object|null
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return array|object|null
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}