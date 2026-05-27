<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

/**
 * HTTP status codes.
 */
enum StatusCode: int
{
    case OK = 200;
    case NotFound = 404;
}
