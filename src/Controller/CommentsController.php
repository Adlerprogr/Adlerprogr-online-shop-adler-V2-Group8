<?php

namespace Controller;

use Repository\CommentsImageRepository;
use Repository\CommentsRepository;
use Repository\ImageRepository;
use Repository\OrderProductRepository;
use Repository\UserRepository;
use Request\CommentsRequest;
use Service\Authentication\AuthenticationInterfaceService;
use Repository\ProductRepository;
use Service\ImageService;


class CommentsController
{
    private AuthenticationInterfaceService $authenticationService;
    private ProductRepository $productRepository;
    private UserRepository $userRepository;
    private CommentsRepository $commentsRepository;
    private OrderProductRepository $orderProductRepository;
    private ImageService $imageService;
    private ImageRepository $imageRepository;
    private CommentsImageRepository $commentsImageRepository;

    public function __construct(AuthenticationInterfaceService $authenticationService, ProductRepository $productRepository, UserRepository $userRepository, CommentsRepository $commentsRepository, OrderProductRepository $orderProductRepository, ImageService $imageService, ImageRepository $imageRepository, CommentsImageRepository $commentsImageRepository)
    {
        $this->authenticationService = $authenticationService;
        $this->productRepository = $productRepository;
        $this->userRepository = $userRepository;
        $this->commentsRepository = $commentsRepository;
        $this->orderProductRepository = $orderProductRepository;
        $this->imageService = $imageService;
        $this->imageRepository = $imageRepository;
        $this->commentsImageRepository = $commentsImageRepository;
    }

    public function getComments(CommentsRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $userId = $this->authenticationService->sessionOrCookie();
        $arr = $request;

        $user = $this->userRepository->getUserById($userId);
        $products = $this->productRepository->getProductById($arr->getProductId());

        $commentsImage = $this->commentsImageRepository->getCommentsImage($arr->getProductId());

        $checkOrderProduct = $this->orderProductRepository->checkOrderProduct($userId, $arr->getProductId());

        if (empty($commentsImage)) {
            $massage = 'Комментариев нет';
        }

        require_once './../View/comments.php';
    }

    public function postComments(CommentsRequest $request): void
    {
        if (!$this->authenticationService->check()) {
            header("Location: /login");
        }

        $userId = $this->authenticationService->sessionOrCookie();
        $arr = $request;

        $user = $this->userRepository->getUserById($userId);
        $products = $this->productRepository->getProductById($arr->getProductId());

        $this->commentsRepository->create($userId, $arr->getProductId(), $arr->getComments());
        $commentsId = $this->commentsRepository->getCommentsId();

        $this->imageService->addImage();

        $checkImageId = $this->imageRepository->getImageId();

        $this->commentsImageRepository->create($commentsId, $checkImageId);

        $commentsImage = $this->commentsImageRepository->getCommentsImage($arr->getProductId());

        if (empty($commentsImage)) {
            $massage = 'Комментариев нет';
        }

        require_once './../View/comments.php';
    }
}