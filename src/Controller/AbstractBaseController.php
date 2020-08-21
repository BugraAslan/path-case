<?php

namespace App\Controller;

use App\Manager\Response\PaginationResponseManager;
use App\Model\Response\ApiResponseModel;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

abstract class AbstractBaseController extends AbstractFOSRestController
{
    /** @var PaginationResponseManager */
    public $paginationResponseManager;

    /** @var ApiResponseModel */
    public $notFoundResponse;

    /**
     * @param PaginationResponseManager $paginationResponseManager
     * @required
     */
    public function setBaseControllerArguments(PaginationResponseManager $paginationResponseManager): void
    {
        $this->paginationResponseManager = $paginationResponseManager;
        $this->notFoundResponse = new ApiResponseModel(
            false,
            null,
            'Data is not found',
            Response::HTTP_NOT_FOUND
        );
    }

    /**
     * @param ApiResponseModel $apiResponseModel
     * @return Response
     */
    public function apiResponse(ApiResponseModel $apiResponseModel)
    {
        return $this->handleView(
            (new View())
                ->setFormat('json')
                ->setStatusCode($apiResponseModel->getStatusCode())
                ->setData([
                    'success' => $apiResponseModel->isSuccess(),
                    'data' => $apiResponseModel->getData(),
                    'errors' => $apiResponseModel->getErrors()
                ])
        );
    }

    /**
     * @param ConstraintViolationListInterface $validationErrors
     * @return Response
     */
    public function validationErrorResponse(ConstraintViolationListInterface $validationErrors)
    {
        $errors = [];
        if ($validationErrors->count()){
            foreach ($validationErrors as $validationError){
                $errors[$validationError->getPropertyPath()][] = $validationError->getMessage();
            }
        }

        return $this->apiResponse(
            new ApiResponseModel(
                false,
                null,
                $errors,
                Response::HTTP_BAD_REQUEST
            )
        );
    }

    /**
     * @param $error
     * @param int $statusCode
     * @return Response
     */
    public function customErrorResponse($error, int $statusCode)
    {
        return $this->apiResponse(
            new ApiResponseModel(
                false,
                null,
                $error,
                $statusCode
            )
        );
    }
}