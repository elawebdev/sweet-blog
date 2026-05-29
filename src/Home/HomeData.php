<?php

declare(strict_types=1);

namespace SweetBlog\Home;

use SweetBlog\Core\View\ViewData;

final readonly class HomeData implements ViewData
{
    public function __construct(
        public string $title,
    ) {}
}
