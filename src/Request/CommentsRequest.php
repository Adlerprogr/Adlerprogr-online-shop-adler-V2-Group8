<?php

namespace Request;

use Adler\Corepackege\Request;

class CommentsRequest extends Request
{
    public function getProductId()
    {
        return $this->body['product_id'];
    }

    public function getFileImgUrl()
    {
        return $this->body['img_url'];
    }

    public function getComments()
    {
        return $this->body['text_comments'];
    }
}