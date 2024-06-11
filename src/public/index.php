<?php

use Core\App;
use Core\Autoloader;
use Core\Container;
use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\UserController;
use Controller\UserProductController;
use Repository\ProductRepository;
use Repository\UserProductRepository;
use Repository\UserRepository;
use Request\CartRequest;
use Request\LoginRequest;
use Request\OrderRequest;
use Request\RegistrationRequest;
use Request\UserProductRequest;
use Service\CartService;
use Service\OrderService;

require_once './../Core/Autoloader.php';

$dir = dirname(__DIR__);
Autoloader::registration($dir);

$container = new Container();

$container->set(CartController::class, function () {
    $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService();
    $cartService = new CartService();
    $userProductRepository = new UserProductRepository();

    return new CartController($authenticationService , $cartService, $userProductRepository);
});

$container->set(MainController::class, function () {
    $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService();
    $productRepository = new ProductRepository();
    $userProductRepository = new UserProductRepository();

    return new MainController($authenticationService , $productRepository, $userProductRepository);
});

$container->set(OrderController::class, function () {
    $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService();
    $orderService = new OrderService();

    return new OrderController($authenticationService , $orderService);
});

$container->set(UserController::class, function () {
    $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService();
    $userRepository = new UserRepository();

    return new UserController($authenticationService ,$userRepository);
});

$container->set(UserProductController::class, function () {
    $authenticationService = new \Service\Authentication\CookieAuthenticationInterfaceService();
    $cartService = new CartService();
    $productRepository = new ProductRepository();

    return new UserProductController($authenticationService , $cartService, $productRepository);
});

$app = new App($container);

$app->get('/registration', UserController::class, 'getRegistration');
$app->post('/registration', UserController::class, 'postRegistration', RegistrationRequest::class);

$app->get('/login', UserController::class, 'getLogin');
$app->post('/login', UserController::class, 'postLogin', LoginRequest::class);

$app->get('/main', MainController::class, 'getMainPage');

$app->get('/add-product', UserProductController::class, 'getProducts');
$app->post('/add-product', UserProductController::class, 'postAddProducts', UserProductRequest::class);

$app->get('/cart', CartController::class, 'getCart');

$app->post('/delete-product', CartController::class, 'deleteProduct', CartRequest::class);

$app->post('/plus-product', CartController::class, 'addProductCart', CartRequest::class);

$app->get('/order', OrderController::class, 'getOrder');
$app->post('/order', OrderController::class, 'postOrder', OrderRequest::class);

$app->run();