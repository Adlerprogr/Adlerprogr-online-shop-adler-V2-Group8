<?php

namespace Service\Authentication;

use Entity\User;

interface AuthenticationInterfaceService
{
    public function check(): bool;
    public function getCurrentUser(): User|null;
    public function authenticate(string $email, string $password): bool;
    public function sessionOrCookie(): int;
}