<?php

namespace Controller;

use Repository\OrderRepository;
use Repository\OrderProductRepository;
use Repository\UserProductRepository;
use Request\OrderRequest;

class OrderController
{
    private OrderRepository $modelOrder;
    private OrderProductRepository $modelOrderProduct;
    private UserProductRepository $modelUserProduct;

    public function __construct()
    {
        $this->modelOrder = new OrderRepository();
        $this->modelOrderProduct = new OrderProductRepository();
        $this->modelUserProduct = new UserProductRepository();
    }

    public function getOrder()
    {
        session_start();

        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
        }

        require_once './../View/order.php';
    }

    public function postOrder(OrderRequest $request): void
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }
        } else {
            if (!isset($_SESSION['user_id'])) {
                header("Location: /login");
            }
        }

        $errors = $request->validate();
        $arr = $request->getBody();

        if (empty($errors)) {
            $userId = $_SESSION['user_id'];

            $email = $arr['email'];
            $phone = $arr['phone'];
            $name = $arr['name'];
            $address = $arr['address'];
            $city = $arr['city'];
            $postal_code = $arr['postal_code'];
            $country = $arr['country'];

            $this->modelOrder->createOrder($email, $phone, $name, $address, $city, $postal_code, $country);

            $orderId = $this->modelOrder->getOrderId();

            $this->modelOrderProduct->createOrderProduct($userId, $orderId);
            $this->modelUserProduct->allDeleteProduct($userId);
        }

        require_once './../View/order.php';
    }
}