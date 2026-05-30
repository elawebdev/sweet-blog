<?php

declare(strict_types=1);

namespace SweetBlog\DTOs;

use SweetBlog\Core\View\ViewData;

final readonly class PostData implements ViewData
{
    public function __construct(
        public string $title,
        public string $content,
        public string $author,
        public string $createdAt,
    ) {}
}
