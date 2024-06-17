<?php

namespace Core;

class Container
{
    private array $services = [];

    public function __construct(array $services)
    {
        $this->services = $services;
    }

    public function set(string $class, callable $callback): void
    {
        $this->services[$class] = $callback;
    }

    public function get(string $class): object
    {
        if (isset($this->services[$class])) {
            $callback = $this->services[$class];

            return $callback($this);
        }

        return new $class();
    }
}