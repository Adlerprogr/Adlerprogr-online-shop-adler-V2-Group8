<?php

namespace Controller;

use Service\Authentication\AuthenticationInterfaceService;
use Service\OrderService;
use Request\OrderRequest;

class OrderController
{
    private AuthenticationInterfaceService $authenticationService;
    private OrderService $orderService;

    public function __construct(AuthenticationInterfaceService $authenticationService)
    {
        $this->authenticationService = $authenticationService;
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
            $userId = $this->authenticationService->sessionOrCookie();

            $this->orderService->create($userId, $arr);
        }

        require_once './../View/order.php';
    }
}