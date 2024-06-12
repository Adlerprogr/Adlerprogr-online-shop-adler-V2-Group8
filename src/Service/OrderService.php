<?php

namespace Service;

use Repository\OrderProductRepository;
use Repository\OrderRepository;
use Repository\UserProductRepository;

class OrderService
{
    private OrderRepository $orderRepository;
    private OrderProductRepository $orderProductRepository;
    private UserProductRepository $userProductRepository;

    public function __construct(OrderRepository $orderRepository, OrderProductRepository $orderProductRepository, UserProductRepository $userProductRepository)
    {
        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->userProductRepository = $userProductRepository;
    }
    public function create(string $userId, array $arr): void
    {
        $this->orderRepository->createOrder($arr['email'], $arr['phone'], $arr['name'], $arr['address'], $arr['city'], $arr['postal_code'], $arr['country']);

        $orderId = $this->orderRepository->getOrderId();

        $this->orderProductRepository->createOrderProduct($userId, $orderId);
        $this->userProductRepository->allDeleteProduct($userId);
    }
}