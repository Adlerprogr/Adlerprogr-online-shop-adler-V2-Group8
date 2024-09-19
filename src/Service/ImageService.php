<?php

namespace Service;

use Repository\ImageRepository;

class ImageService
{
    private ImageRepository $imageRepository;

    public function __construct(ImageRepository $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }
    public function uploadImg($file, $name): void
    {
        copy($file['tmp_name'], './../public/image/' . $name);
    }
    public function addImage(): void
    {
        $file = $_FILES['img_url'];
        if (isset($file)) {
            $name = mt_rand(0, 1000) . $file['name'];
            $this->uploadImg($file, $name);
            $path='http://localhost:80/image/';
            $image = $path . $name;
            $this->imageRepository->create($image);
        }
    }
}