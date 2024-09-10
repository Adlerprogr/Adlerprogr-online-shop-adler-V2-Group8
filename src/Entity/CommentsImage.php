<?php

namespace Entity;

class CommentsImage
{
    private int $id;
    private Comments $commentsId;
    private Image $imageId;

    public function __construct(int $id, Comments $commentsId, Image $imageId = null)
    {
        $this->id = $id;
        $this->commentsId = $commentsId;
        $this->imageId = $imageId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getCommentsId(): Comments
    {
        return $this->commentsId;
    }

    public function setCommentsId(Comments $commentsId): void
    {
        $this->commentsId = $commentsId;
    }

    public function getImageId(): Image
    {
        return $this->imageId;
    }

    public function setImageId(Image $imageId): void
    {
        $this->imageId = $imageId;
    }


}