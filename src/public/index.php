<?php

use Controller\CommentsController;
//use Core\App;
use Adler\Corepackege\App;
//use Core\Autoloader;
use Adler\Corepackege\Autoloader;
//use Core\Container;
use Adler\Corepackege\Container;
use Controller\CartController;
use Controller\MainController;
use Controller\OrderController;
use Controller\UserController;
use Controller\UserProductController;
use Request\CartRequest;
use Request\CommentsRequest;
use Request\LoginRequest;
use Request\OrderRequest;
use Request\RegistrationRequest;
use Request\UserProductRequest;

require_once './../../vendor/autoload.php';

$dir = dirname(__DIR__);
Autoloader::registration($dir);

$services = include './../Config/Services.php';

$container = new Container($services);

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

$app->post('/comments', CommentsController::class, 'getComments', \Request\CommentsRequest::class);
$app->post('/comments-product', CommentsController::class, 'postComments', CommentsRequest::class);

$app->run();