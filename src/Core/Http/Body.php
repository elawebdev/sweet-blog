<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

final readonly class Body
{
    public function __construct(
        public private(set) string $content = '',
    ) {}
}
