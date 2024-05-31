<?php

namespace Controller;

use Repository\UserRepository;
use Request\LoginRequest;
use Request\RegistrationRequest;
use Service\Authentication\CookieAuthenticationService;
use Service\Authentication\SessionAuthenticationService;

class UserController
{
    private UserRepository $userRepository;
//    private SessionAuthenticationService  $authenticationService;
    private CookieAuthenticationService  $authenticationService;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
//        $this->authenticationService = new SessionAuthenticationService();
        $this->authenticationService = new CookieAuthenticationService();
    }

    public function getRegistration(): void
    {
        require_once './../View/registration.php';
    }

    public function postRegistration(RegistrationRequest $request): void
    {
        $errors = $request->validate();
        $arr = $request->getBody();

        if (empty($errors)) {
            $firstName = $arr['first_name'];
            $lastName = $arr['last_name'];
            $email = $arr['email'];
            $password = password_hash($arr['password'], PASSWORD_DEFAULT);
            $repeatPassword = password_hash($arr['repeat_password'], PASSWORD_DEFAULT);

            $this->userRepository->create($firstName, $lastName, $email, $password, $repeatPassword);
        }

        require_once './../View/login.php';
    }

    public function getLogin(): void
    {
        require_once './../View/login.php';
    }

    public function postLogin(LoginRequest $request): void
    {
        $errors = $request->validate();
        $arr = $request->getBody();

        if (empty($errors)) {
            $email = $arr['email'];
            $password = $arr['password'];

            $result = $this->authenticationService->authenticate($email, $password);

            if ($result) {
                header("Location: /main");
            } else {
                echo 'Login or password not valid';
            }
        }

        require_once './../View/login.php';
    }
}