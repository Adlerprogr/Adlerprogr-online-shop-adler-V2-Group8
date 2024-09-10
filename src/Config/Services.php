<?php

use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\UserController;
use Controller\UserProductController;
use Repository\CommentsRepository;
use Repository\ImageRepository;
use Repository\OrderProductRepository;
use Repository\OrderRepository;
use Repository\ProductRepository;
use Repository\UserProductRepository;
use Repository\UserRepository;
use Repository\CommentsImageRepository;
use Service\CartService;
use Service\ImageService;
use Service\OrderService;

return [
    // Controller
    CartController::class => function (\Core\Container $container) {
        $authenticationService = $container->get(\Service\Authentication\AuthenticationInterfaceService::class);
        $cartService = $container->get(\Service\CartService::class);
        $userProductRepository = $container->get(UserProductRepository::class);

        return new CartController($authenticationService , $cartService, $userProductRepository);
    },
    MainController::class => function (\Core\Container $container) {
        $authenticationService = $container->get(\Service\Authentication\AuthenticationInterfaceService::class);
        $productRepository = $container->get(ProductRepository::class);
        $userProductRepository = $container->get(UserProductRepository::class);

        return new MainController($authenticationService , $productRepository, $userProductRepository);
    },
    OrderController::class => function (\Core\Container $container) {
        $authenticationService = $container->get(\Service\Authentication\AuthenticationInterfaceService::class);
        $orderService = $container->get(OrderService::class);

        return new OrderController($authenticationService , $orderService);
    },
    UserController::class => function (\Core\Container $container) {
        $authenticationService = $container->get(\Service\Authentication\AuthenticationInterfaceService::class);
        $userRepository = $container->get(UserRepository::class);

        return new UserController($authenticationService ,$userRepository);
    },
    UserProductController::class => function (\Core\Container $container) {
        $authenticationService = $container->get(\Service\Authentication\AuthenticationInterfaceService::class);
        $cartService = $container->get(\Service\CartService::class);
        $productRepository = $container->get(ProductRepository::class);

        return new UserProductController($authenticationService , $cartService, $productRepository);
    },
    \Controller\CommentsController::class => function (\Core\Container $container) {
        $authenticationService = $container->get(\Service\Authentication\AuthenticationInterfaceService::class);
        $productRepository = $container->get(ProductRepository::class);
        $userRepository = $container->get(UserRepository::class);
        $commentsRepository = $container->get(CommentsRepository::class);
        $orderProductRepository = $container->get(OrderProductRepository::class);
        $imageService = $container->get(ImageService::class);
        $imageRepository = $container->get(ImageRepository::class);
        $commentsImageRepository = $container->get(CommentsImageRepository::class);

        return new \Controller\CommentsController($authenticationService, $productRepository, $userRepository, $commentsRepository, $orderProductRepository, $imageService, $imageRepository, $commentsImageRepository);
    },

    // Service
    CartService::class => function (\Core\Container $container) {
        $userProductRepository = $container->get(UserProductRepository::class);

        return new CartService($userProductRepository);
    },
    OrderService::class => function (\Core\Container $container) {
        $orderRepository = $container->get(OrderRepository::class);
        $orderProductRepository = $container->get(OrderProductRepository::class);
        $userProductRepository = $container->get(UserProductRepository::class);

        return new OrderService($container, $orderRepository, $orderProductRepository, $userProductRepository);
    },
    \Service\Authentication\AuthenticationInterfaceService::class => function (\Core\Container $container) {
        $userRepository = $container->get(UserRepository::class);

        return new Service\Authentication\CookieAuthenticationInterfaceService($userRepository);
    },
    ImageService::class => function (\Core\Container $container) {
        $imageRepository = $container->get(ImageRepository::class);

        return new ImageService($imageRepository);
    },

    // Logger
    \Core\LoggerInterface::class => function (\Core\Container $container) {
        return new \Core\Logger();
    }
];
