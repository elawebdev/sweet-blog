<?php

declare(strict_types=1);

namespace SweetBlog\Core\Router;

use SweetBlog\Core\Http\Method;

/**
 * A single route.
 */
final readonly class Route
{
    /**
     * @param Method $method HTTP request method
     * @param string $pattern Regular expression to match the request URI
     * @param string $handler Handler class name
     */
    public function __construct(
        public Method $method,
        public string $pattern,
        public string $handler,
    ) {}
}
