<?php

namespace Controller;

use Adler\Corepackege\AuthenticationInterfaceService;
use Repository\UserRepository;
use Request\RegistrationRequest;
use Request\LoginRequest;

class UserController
{
    private AuthenticationInterfaceService $authenticationService;
    private UserRepository $userRepository;

    public function __construct(AuthenticationInterfaceService $authenticationService, UserRepository $userRepository)
    {
        $this->authenticationService = $authenticationService;
        $this->userRepository = $userRepository;
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