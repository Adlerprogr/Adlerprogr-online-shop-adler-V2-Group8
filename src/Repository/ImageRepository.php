<?php

namespace Repository;

use Adler\Corepackege\Repository;
use Entity\Image;

class ImageRepository extends Repository
{
    public function create($imgUrl): void
    {
        $stmt = self::getPdo()->prepare("INSERT INTO image (img_url) VALUES (:img_url)");
        $stmt->execute(['img_url' => $imgUrl]);
    }

    public function getImageId(): false|string
    {
        return self::getPdo()->lastInsertId();
    }

    public function getImage($imageId)
    {
        $stmt = self::getPdo()->prepare('SELECT * FROM images WHERE id = :id');
        $stmt->execute(['id' => $imageId]);

        $result = $stmt->fetch();

        if (empty($result)) {
            return null;
        }

        return $this->hydrate($result);
    }

    private function hydrate(array $data): Image
    {
        return new Image($data['id'], $data['img_url']);
    }
}