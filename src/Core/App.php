<?php

namespace Core;

class App
{
    private array $routes = [];

    public function run(): void
    {
        $uri = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];

        if (isset($this->routes[$uri])) {
            $routeMethod = $this->routes[$uri];
            if (isset($routeMethod[$method])) {
                $handler = $routeMethod[$method];

                $class = $handler['class'];
                $function = $handler['method'];

                $obj = new $class;
                $obj->$function();
            } else {
                echo "$method is not supported for $uri";
            }
        } else {
            require_once './../View/404.html';
        }
    }

    public function get(string $route, string $class, string $method): void
    {
        $this->routes[$route]['GET'] = ['class' => $class, 'method' => $method];
    }

    public function post(string $route, string $class, string $method): void
    {
        $this->routes[$route]['POST'] = ['class' => $class, 'method' => $method];
    }
}