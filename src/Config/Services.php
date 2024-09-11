<?php

use Adler\Corepackege\Container;
use Adler\Corepackege\LoggerInterface;
use Adler\Corepackege\Logger;
use Adler\Corepackege\AuthenticationInterfaceService;
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
    CartController::class => function (Container $container) {
        $authenticationService = $container->get(AuthenticationInterfaceService::class);
        $cartService = $container->get(\Service\CartService::class);
        $userProductRepository = $container->get(UserProductRepository::class);

        return new CartController($authenticationService , $cartService, $userProductRepository);
    },
    MainController::class => function (Container $container) {
        $authenticationService = $container->get(AuthenticationInterfaceService::class);
        $productRepository = $container->get(ProductRepository::class);
        $userProductRepository = $container->get(UserProductRepository::class);

        return new MainController($authenticationService , $productRepository, $userProductRepository);
    },
    OrderController::class => function (Container $container) {
        $authenticationService = $container->get(AuthenticationInterfaceService::class);
        $orderService = $container->get(OrderService::class);

        return new OrderController($authenticationService , $orderService);
    },
    UserController::class => function (Container $container) {
        $authenticationService = $container->get(AuthenticationInterfaceService::class);
        $userRepository = $container->get(UserRepository::class);

        return new UserController($authenticationService ,$userRepository);
    },
    UserProductController::class => function (Container $container) {
        $authenticationService = $container->get(AuthenticationInterfaceService::class);
        $cartService = $container->get(\Service\CartService::class);
        $productRepository = $container->get(ProductRepository::class);

        return new UserProductController($authenticationService , $cartService, $productRepository);
    },
    \Controller\CommentsController::class => function (Container $container) {
        $authenticationService = $container->get(AuthenticationInterfaceService::class);
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
    CartService::class => function (Container $container) {
        $userProductRepository = $container->get(UserProductRepository::class);

        return new CartService($userProductRepository);
    },
    OrderService::class => function (Container $container) {
        $orderRepository = $container->get(OrderRepository::class);
        $orderProductRepository = $container->get(OrderProductRepository::class);
        $userProductRepository = $container->get(UserProductRepository::class);

        return new OrderService($container, $orderRepository, $orderProductRepository, $userProductRepository);
    },
    AuthenticationInterfaceService::class => function (Container $container) {
        $userRepository = $container->get(UserRepository::class);

        return new Service\Authentication\CookieAuthenticationInterfaceService($userRepository);
    },
    ImageService::class => function (Container $container) {
        $imageRepository = $container->get(ImageRepository::class);

        return new ImageService($imageRepository);
    },

    // Logger
    LoggerInterface::class => function (Container $container) {
        return new Logger();
    }
];
