<?php

use Core\App;
use Core\Autoloader;
use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\UserController;
use Controller\UserProductController;
use Request\CartRequest;
use Request\OrderRequest;
use Request\UserProductRequest;
use Request\RegistrationRequest;
use Request\LoginRequest;
use Request\Request;

require_once './../Core/Autoloader.php';

$dir = dirname(__DIR__);
Autoloader::registration($dir);

$app = new App();
$app->get('/registration', UserController::class, 'getRegistration', Request::class);
$app->post('/registration', UserController::class, 'postRegistration', RegistrationRequest::class);
$app->get('/login', UserController::class, 'getLogin', Request::class);
$app->post('/login', UserController::class, 'postLogin', LoginRequest::class);
$app->get('/main', MainController::class, 'getMainPage', Request::class);
$app->get('/add-product', UserProductController::class, 'getProducts', Request::class);
$app->post('/add-product', UserProductController::class, 'postAddProducts', UserProductRequest::class);
$app->get('/cart', CartController::class, 'getCart', Request::class);
$app->post('/delete-product', CartController::class, 'deleteProduct', CartRequest::class);
$app->post('/plus-product', CartController::class, 'addProductCart', CartRequest::class);
$app->get('/order', OrderController::class, 'getOrder', Request::class);
$app->post('/order', OrderController::class, 'postOrder', OrderRequest::class);
$app->run();