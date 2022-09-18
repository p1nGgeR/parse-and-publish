<?php

namespace App\Dto;

class ArticleDto
{
    public function __construct(
        public string $url,
        public string $title,
        public ?string $description = null,
        public ?string $imageUrl = null,
    )
    {
    }
}
