<?php

namespace Core;

use Request\Request;
use Service\Authentication\AuthenticationInterfaceService;
use Service\Authentication\CookieAuthenticationInterfaceService;
use Core\Container;

class App
{
    private Container $container;
    private array $routes = [];

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function run():void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$uri])) {
            $routeMethod = $this->routes[$uri];
            if (isset($routeMethod[$method])) {
                $handler = $routeMethod[$method];

                $class = $handler['class'];
                $function = $handler['method'];

                if (isset($handler['request'])) {
                    $requestClass = $handler['request'];
                    $request = new $requestClass($method, $uri, headers_list(), $_POST);
                } else {
                    $request = new Request($method, $uri, headers_list(), $_POST);
                }

                $obj = $this->container->get($class);
                $obj->$function($request);
            } else {
                echo "$method is not supported for $uri";
            }
        } else {
            require_once './../View/404.html';
        }
    }

    public function get(string $route, string $class, string $method, string $request = null): void
    {
        $this->routes[$route]['GET'] = [
            'class' => $class,
            'method' => $method,
            'request' => $request
        ];
    }

    public function post(string $route, string $class, string $method, string $request = null): void
    {
        $this->routes[$route]['POST'] = [
            'class' => $class,
            'method' => $method,
            'request' => $request
        ];
    }
}