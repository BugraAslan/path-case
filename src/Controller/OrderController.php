<?php

namespace App\Controller;

use App\Entity\Orders;
use App\Manager\Response\OrderResponseManager;
use App\Model\Request\OrderCreateRequestModel;
use App\Model\Request\OrderFilterRequestModel;
use App\Model\Request\OrderListRequestModel;
use App\Model\Request\OrderUpdateRequestModel;
use App\Model\Response\ApiResponseModel;
use App\Service\OrderProductService;
use App\Service\OrderService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

class OrderController extends AbstractBaseController
{
    /** @var OrderService */
    protected $orderService;

    /** @var OrderProductService */
    protected $orderProductService;

    /** @var OrderResponseManager */
    protected $orderResponseManager;

    /**
     * OrderController constructor.
     * @param OrderService $orderService
     * @param OrderProductService $orderProductService
     * @param OrderResponseManager $orderResponseManager
     */
    public function __construct(
        OrderService $orderService,
        OrderProductService $orderProductService,
        OrderResponseManager $orderResponseManager
    ) {
        $this->orderService = $orderService;
        $this->orderProductService = $orderProductService;
        $this->orderResponseManager = $orderResponseManager;
    }

    /**
     * @param OrderListRequestModel $orderListRequestModel
     * @param ConstraintViolationListInterface $validationErrors
     * @ParamConverter("orderListRequestModel", converter="fos_rest.request_body")
     * @return Response
     */
    public function getOrderList(
        OrderListRequestModel $orderListRequestModel,
        ConstraintViolationListInterface $validationErrors
    ): Response {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        $orderListData = $this->orderService->getOrderListByClient(
            $orderListRequestModel,
            $this->getUser()
        );

        if (empty($orderListData->getItems())){
            return $this->apiResponse($this->notFoundResponse);
        }

        $orderCollection = new ArrayCollection();
        foreach ($orderListData->getItems() as $order){
            $orderCollection->add(
                $this->orderResponseManager->buildOrder(
                    $order,
                    $this->orderProductService->getProductsByOrderId($order->getId())
                )
            );
        }

        return $this->apiResponse(
            new ApiResponseModel(
                true,
                [
                    'orders' => $orderCollection->toArray(),
                    'pagination' => $this->paginationResponseManager->build($orderListData)
                ]
            )
        );
    }

    /**
     * @param OrderFilterRequestModel $orderFilterRequestModel
     * @param ConstraintViolationListInterface $validationErrors
     * @ParamConverter("orderFilterRequestModel", converter="fos_rest.request_body")
     * @return Response
     */
    public function getOrderByFilter(
        OrderFilterRequestModel $orderFilterRequestModel,
        ConstraintViolationListInterface $validationErrors
    ): Response {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        $orderFilterData = $this->orderService->getOrderByFilter(
            $orderFilterRequestModel,
            $this->getUser()
        );

        if (empty($orderFilterData->getItems())){
            return $this->apiResponse($this->notFoundResponse);
        }

        $orderCollection = new ArrayCollection();
        foreach ($orderFilterData->getItems() as $order){
            $orderCollection->add(
                $this->orderResponseManager->buildOrder(
                    $order,
                    $this->orderProductService->getProductsByOrderId($order->getId())
                )
            );
        }

        return $this->apiResponse(
            new ApiResponseModel(
                true,
                [
                    'orders' => $orderCollection->toArray(),
                    'pagination' => $this->paginationResponseManager->build($orderFilterData)
                ]
            )
        );
    }

    /**
     * @param OrderUpdateRequestModel $orderUpdateRequestModel
     * @param ConstraintViolationListInterface $validationErrors
     * @return Response
     * @throws ORMException
     * @throws OptimisticLockException
     * @ParamConverter("orderUpdateRequestModel", converter="fos_rest.request_body")
     */
    public function updateOrderAction(
        OrderUpdateRequestModel $orderUpdateRequestModel,
        ConstraintViolationListInterface $validationErrors
    ): Response {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        $orderEntity = $this->orderService->getOrderByOrderCode(
            $orderUpdateRequestModel->getOrderCode(),
            $this->getUser()->getId()
        );

        if (!$orderEntity instanceof Orders){
            return $this->apiResponse($this->notFoundResponse);
        }

        $updatedOrderEntity = $this->orderService->updateOrder(
            $orderUpdateRequestModel,
            $orderEntity
        );

        if (!$updatedOrderEntity){
            return $this->customErrorResponse(
                'Shipping Date is Expired',
                Response::HTTP_NOT_ACCEPTABLE
            );
        }

        return $this->apiResponse(
            new ApiResponseModel(
                true,
                [
                    'order' => $updatedOrderEntity
                ]
            )
        );
    }

    /**
     * @param OrderCreateRequestModel $orderCreateRequestModel
     * @param ConstraintViolationListInterface $validationErrors
     * @ParamConverter("orderCreateRequestModel", converter="fos_rest.request_body")
     * @return Response
     */
    public function createOrderAction(
        OrderCreateRequestModel $orderCreateRequestModel,
        ConstraintViolationListInterface $validationErrors
    ): Response {
        if ($validationErrors->count()){
            return $this->validationErrorResponse($validationErrors);
        }

        $trackingId = $this->orderService->createOrder($orderCreateRequestModel, $this->getUser());

        if (!$trackingId){
            return $this->customErrorResponse(
                'OrderCode Already Exists',
                Response::HTTP_CONFLICT
            );
        }

        return $this->apiResponse(
            new ApiResponseModel(
                true,
                [
                    'message' => 'Order is Saved',
                    'trackingId' => $trackingId
                ],
                null,
                Response::HTTP_CREATED
            )
        );
    }
}