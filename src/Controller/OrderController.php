<?php

namespace Controller;

use Adler\Corepackege\AuthenticationInterfaceService;
use Service\OrderService;
use Request\OrderRequest;

class OrderController
{
    private AuthenticationInterfaceService $authenticationService;
    private OrderService $orderService;

    public function __construct(AuthenticationInterfaceService $authenticationService, OrderService $orderService)
    {
        $this->authenticationService = $authenticationService;
        $this->orderService = $orderService;
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
            // Добавить сюда try/cath чтобы при успешном выполнении оформления заказа переходить на главную страницу
            // if ($result) {
            //     header("Location: /main");
            // } else {
            //     echo 'Login or password not valid';
            // }
        }

        require_once './../View/order.php';
    }
}