<?php

declare(strict_types=1);

namespace SweetBlog\DTOs;

use SweetBlog\Core\View\ViewData;
use SweetBlog\Entities\PostListItemEntity;

final readonly class HomeData implements ViewData
{
    /**
     * @param string $title Post title
     * @param array<PostListItemEntity> $postList List of recent posts
     */
    public function __construct(
        public string $title,
        public array $postList,
    ) {}
}
