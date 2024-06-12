<?php

use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\UserController;
use Controller\UserProductController;
use Repository\OrderProductRepository;
use Repository\OrderRepository;
use Repository\ProductRepository;
use Repository\UserProductRepository;
use Repository\UserRepository;
use Service\CartService;
use Service\OrderService;

return [
    CartController::class => function () {
        $userRepository = new UserRepository();
        $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService($userRepository);
        $userProductRepository = new UserProductRepository();
        $cartService = new CartService($userProductRepository);
        $userProductRepository = new UserProductRepository();

        return new CartController($authenticationService , $cartService, $userProductRepository);
    },
    MainController::class => function () {
        $userRepository = new UserRepository();
        $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService($userRepository);
        $productRepository = new ProductRepository();
        $userProductRepository = new UserProductRepository();

        return new MainController($authenticationService , $productRepository, $userProductRepository);
    },
    OrderController::class => function () {
        $userRepository = new UserRepository();
        $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService($userRepository);
        $orderRepository = new OrderRepository();
        $orderProductRepository = new OrderProductRepository();
        $userProductRepository = new UserProductRepository();
        $orderService = new OrderService($orderRepository, $orderProductRepository, $userProductRepository);

        return new OrderController($authenticationService , $orderService);
    },
    UserController::class => function () {
        $userRepository = new UserRepository();
        $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService($userRepository);
        $userRepository = new UserRepository();

        return new UserController($authenticationService ,$userRepository);
    },
    UserProductController::class => function () {
        $userRepository = new UserRepository();
        $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService($userRepository);
        $userProductRepository = new UserProductRepository();
        $cartService = new CartService($userProductRepository);
        $productRepository = new ProductRepository();

        return new UserProductController($authenticationService , $cartService, $productRepository);
    },
    CartService::class => function () {
        $userProductRepository = new UserProductRepository();

        return new CartService($userProductRepository);
    },
    OrderService::class => function () {
        $orderRepository = new OrderRepository();
        $orderProductRepository = new OrderProductRepository();
        $userProductRepository = new UserProductRepository();

        return new OrderService($orderRepository, $orderProductRepository, $userProductRepository);
    },
    \Service\Authentication\CookieAuthenticationInterfaceService::class => function () {
        $userRepository = new UserRepository();

        return new Service\Authentication\CookieAuthenticationInterfaceService($userRepository);
    },
    \Service\Authentication\SessionAuthenticationService::class => function () {
        $userRepository = new UserRepository();

        return new \Service\Authentication\CookieAuthenticationInterfaceService($userRepository);
    }
];
