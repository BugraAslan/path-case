<?php

namespace App\Service;

use App\Builder\Director;
use App\Entity\Orders;
use App\Manager\Aggregate\OrderAggregateManager;
use App\Model\Request\OrderCreateRequestModel;
use App\Model\Request\OrderFilterRequestModel;
use App\Model\Request\OrderListRequestModel;
use App\Model\Request\OrderUpdateRequestModel;
use App\Repository\OrdersRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class OrderService extends AbstractBaseService
{
    /** @var OrdersRepository */
    protected $orderRepository;

    /** @var ProductService */
    protected $productService;

    /** @var OrderProductService */
    protected $orderProductService;

    /** @var Director */
    protected $director;

    /** @var OrderAggregateManager */
    protected $orderAggregateManager;

    /**
     * OrderService constructor.
     * @param OrdersRepository $orderRepository
     * @param ProductService $productService
     * @param OrderProductService $orderProductService
     * @param Director $director
     * @param OrderAggregateManager $orderAggregateManager
     */
    public function __construct(
        OrdersRepository $orderRepository,
        ProductService $productService,
        OrderProductService $orderProductService,
        Director $director,
        OrderAggregateManager $orderAggregateManager
    ) {
        $this->orderRepository = $orderRepository;
        $this->productService = $productService;
        $this->orderProductService = $orderProductService;
        $this->director = $director;
        $this->orderAggregateManager = $orderAggregateManager;
    }

    /**
     * @param OrderCreateRequestModel $orderCreateRequestModel
     * @param UserInterface $user
     * @return int|null
     */
    public function createOrder(
        OrderCreateRequestModel $orderCreateRequestModel,
        UserInterface $user
    ) {
        if (!$this->checkOrderCode($orderCreateRequestModel->getOrderCode())){
            return null;
        }

        $orderEntity = (new Orders())
            ->setAddress($orderCreateRequestModel->getAddress())
            ->setCity($orderCreateRequestModel->getCity())
            ->setClientId($user->getId())
            ->setDistrict($orderCreateRequestModel->getDistrict())
            ->setShippingDate($orderCreateRequestModel->getShippingDate())
            ->setEmail($orderCreateRequestModel->getEmail())
            ->setOrderCode($orderCreateRequestModel->getOrderCode())
            ->setPhone($orderCreateRequestModel->getPhone())
            ->setTotalPrice(
                $orderCreateRequestModel->getProductPrice() * $orderCreateRequestModel->getQuantity()
            )
            ->setCreatedDate(new \DateTime());

        $this->entityManager->persist($orderEntity);
        $this->entityManager->flush();

        $this->orderProductService->createOrderProduct(
            $orderEntity->getId(),
            $this->productService->createProductByRequestModel($orderCreateRequestModel),
            $orderCreateRequestModel->getQuantity(),
            $orderCreateRequestModel->getProductId()
        );

        return $orderEntity->getId();
    }

    /**
     * @param string $orderCode
     * @return bool
     */
    private function checkOrderCode(string $orderCode)
    {
        $findOrder = $this->orderRepository->findOneBy(['orderCode' => $orderCode]);

        return !$findOrder instanceof Orders;
    }

    /**
     * @param OrderListRequestModel $orderListRequestModel
     * @param UserInterface $user
     * @return PaginationInterface
     */
    public function getOrderListByClient(
        OrderListRequestModel $orderListRequestModel,
        UserInterface $user
    ) {
        return $this->paginationService->setPagination(
            $this->orderRepository->findOrdersQueryByClientId($user->getId()),
            $orderListRequestModel->getPage(),
            $orderListRequestModel->getSize()
        );
    }

    /**
     * @param OrderFilterRequestModel $orderFilterRequestModel
     * @param UserInterface $user
     * @return PaginationInterface
     */
    public function getOrderByFilter(
        OrderFilterRequestModel $orderFilterRequestModel,
        UserInterface $user
    ) {
        return $this->paginationService->setPagination(
            $this->orderRepository->getOrderFilterQueryByQueryBuilder(
                $this->director->buildOrder($orderFilterRequestModel, $user->getId())
            ),
            $orderFilterRequestModel->getPage(),
            $orderFilterRequestModel->getSize()
        );
    }

    /**
     * @param OrderUpdateRequestModel $orderUpdateRequestModel
     * @param Orders $order
     * @return Orders|null
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function updateOrder(
        OrderUpdateRequestModel $orderUpdateRequestModel,
        Orders $order
    ) {
        if (!$order->getShippingDate()->diff((new \DateTime()))->invert){
            return null;
        }

        $this->orderRepository->save(
            $this->orderAggregateManager->prepareAggregate(
                $order,
                $orderUpdateRequestModel
            )
        );

        return $order;
    }

    /**
     * @param string $orderCode
     * @param int $clientId
     * @return Orders|null
     */
    public function getOrderByOrderCode(string $orderCode, int $clientId)
    {
        return $this->orderRepository->findOrderByOrderCode(
            $orderCode,
            $clientId,
            false,
            1200
        );
    }
}