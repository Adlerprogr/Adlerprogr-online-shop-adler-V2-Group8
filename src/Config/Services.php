<?php

use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\UserController;
use Controller\UserProductController;
use Repository\ProductRepository;
use Repository\UserProductRepository;
use Repository\UserRepository;
use Service\CartService;
use Service\OrderService;

return [
    CartController::class => function () {
        $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService();
        $cartService = new CartService();
        $userProductRepository = new UserProductRepository();

        return new CartController($authenticationService , $cartService, $userProductRepository);
    },
    MainController::class => function () {
        $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService();
        $productRepository = new ProductRepository();
        $userProductRepository = new UserProductRepository();

        return new MainController($authenticationService , $productRepository, $userProductRepository);
    },
    OrderController::class => function () {
        $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService();
        $orderService = new OrderService();

        return new OrderController($authenticationService , $orderService);
    },
    UserController::class => function () {
        $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService();
        $userRepository = new UserRepository();

        return new UserController($authenticationService ,$userRepository);
    },
    UserProductController::class => function () {
        $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService();
        $cartService = new CartService();
        $productRepository = new ProductRepository();

        return new UserProductController($authenticationService , $cartService, $productRepository);
    }
];
