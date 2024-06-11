<?php

namespace Core;

class Container
{
    private array $services = [];

    public function set(string $class, callable $callback): void
    {
        $this->services[$class] = $callback;
    }

    public function get(string $class): object
    {
        $callback = $this->services[$class];

        return $callback();
    }
}