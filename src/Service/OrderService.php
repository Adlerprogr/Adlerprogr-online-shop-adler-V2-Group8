<?php

namespace Service;

use Core\Container;
use Core\Logger;
use Repository\OrderProductRepository;
use Repository\OrderRepository;
use Repository\UserProductRepository;
use Repository\Repository;

class OrderService
{
    private OrderRepository $orderRepository;
    private OrderProductRepository $orderProductRepository;
    private UserProductRepository $userProductRepository;
    private Container $container;

    public function __construct(Container $container, OrderRepository $orderRepository, OrderProductRepository $orderProductRepository, UserProductRepository $userProductRepository)
    {
        $this->container = $container;
        $this->orderRepository = $orderRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->userProductRepository = $userProductRepository;
    }

    public function create(string $userId, array $arr): void
    {
        $pdo = Repository::getPdo();

        $pdo->beginTransaction();

        try {
            $this->orderRepository->createOrder($arr['email'], $arr['phone'], $arr['name'], $arr['address'], $arr['city'], $arr['postal_code'], $arr['country']);

            $orderId = $this->orderRepository->getOrderId();

            $this->orderProductRepository->createOrderProduct($userId, $orderId);
            $this->userProductRepository->allDeleteProduct($userId);
        } catch (\Throwable $exception) {
            $logger = $this->container->get(Logger::class); // Нужно ли создавать каждый раз Logger::class или хватит в app.php?

            $data = [
                'message' => 'message: ' . $exception->getMessage(),
                'file' => 'file: ' . $exception->getFile(),
                'line' => 'line: ' . $exception->getLine(),
            ];

            $logger->error('ORDER ERROR\n', $data);

            require_once '../View/500.html';

            $pdo->rollBack();
        }

        $pdo->commit();
    }
}