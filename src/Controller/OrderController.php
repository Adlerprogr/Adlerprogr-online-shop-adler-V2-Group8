<?php

namespace Controller;

use Request\OrderRequest;
use Service\Authentication\CookieAuthenticationService;
use Service\Authentication\SessionAuthenticationService;
use Service\OrderService;

class OrderController
{
//    private SessionAuthenticationService  $authenticationService;
    private CookieAuthenticationService  $authenticationService;
    private OrderService $orderService;

    public function __construct()
    {
//        $this->authenticationService = new SessionAuthenticationService();
        $this->authenticationService = new CookieAuthenticationService();
        $this->orderService = new OrderService();
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

            $this->orderService->create($userId, $arr);
        }

        require_once './../View/order.php';
    }
}