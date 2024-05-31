<?php

namespace Controller;

use Repository\OrderProductRepository;
use Repository\OrderRepository;
use Repository\UserProductRepository;
use Request\OrderRequest;
use Service\Authentication\CookieAuthenticationService;
use Service\Authentication\SessionAuthenticationService;

class OrderController
{
    private OrderRepository $modelOrder;
    private OrderProductRepository $modelOrderProduct;
    private UserProductRepository $modelUserProduct;
//    private SessionAuthenticationService  $authenticationService;
    private CookieAuthenticationService  $authenticationService;

    public function __construct()
    {
        $this->modelOrder = new OrderRepository();
        $this->modelOrderProduct = new OrderProductRepository();
        $this->modelUserProduct = new UserProductRepository();
//        $this->authenticationService = new SessionAuthenticationService();
        $this->authenticationService = new CookieAuthenticationService();
    }

    public function getOrder(): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        require_once './../View/order.php';
    }

    public function postOrder(OrderRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $errors = $request->validate();
        $arr = $request->getBody();

        if (empty($errors)) {
//        $userId = $_SESSION['user_id']; //Как можно автоматизировать перехода с session в cookie и обратно?
//        $userId = $_COOKIE['user_id'];
            $userId = $this->authenticationService->sessionOrCookie();

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