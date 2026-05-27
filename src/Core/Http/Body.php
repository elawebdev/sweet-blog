<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

/**
 * HTTP response body.
 */
final readonly class Body
{
    public function __construct(
        public string $content,
    ) {}
}
