<?php

use Core\App;
use Core\Autoloader;
use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\UserController;
use Controller\UserProductController;

require_once './../Core/Autoloader.php';

$dir = dirname(__DIR__);
Autoloader::registration($dir);

$app = new App();
$app->get('/registration', UserController::class, 'getRegistration');
$app->post('/registration', UserController::class, 'postRegistration');
$app->get('/login', UserController::class, 'getLogin');
$app->post('/login', UserController::class, 'postLogin');
$app->get('/main', MainController::class, 'getMainPage');
$app->get('/add-product', UserProductController::class, 'getProducts');
$app->post('/add-product', UserProductController::class, 'postAddProducts');
$app->get('/cart', CartController::class, 'getCart');
$app->post('/delete-product', CartController::class, 'deleteProduct');
$app->post('/plus-product', CartController::class, 'addProductCart');
$app->get('/order', OrderController::class, 'getOrder');
$app->post('/order', OrderController::class, 'postOrder');
$app->run();