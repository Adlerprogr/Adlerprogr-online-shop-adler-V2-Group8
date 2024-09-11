<?php

namespace Service\Authentication;

use Entity\User;
use Repository\UserRepository;

class CookieAuthenticationInterfaceService implements \Adler\Corepackege\AuthenticationInterfaceService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function check(): bool
    {
        if (isset($_COOKIE['user_id'])) {
            setcookie('user_id', $_COOKIE['user_id'], time()+3600, '/');

            return true;
        } else {
            return false;
        }
    }

    public function getCurrentUser(): User|null
    {
        if (!$this->check()) {
            return null;
        }

        $userId = $_COOKIE['user_id'];

        return $this->userRepository->getUserById($userId);
    }

    public function authenticate(string $email, string $password): bool
    {
        $getEmail = $this->userRepository->getUserByEmail($email); // !!! object UserRepository

        if (!empty($getEmail)) {
            if (password_verify($password, $getEmail->getPassword())) {
                setcookie('user_id', $getEmail->getId(), time()+3600);

                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function sessionOrCookie(): int
    {
        if (isset($_COOKIE['user_id'])) {
            return $_COOKIE['user_id'];
        } else {
            return $_SESSION['user_id'];
        }
    }
}