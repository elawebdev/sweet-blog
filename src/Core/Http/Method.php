<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

/**
 * HTTP request methods.
 */
enum Method
{
    case GET;
    case HEAD;
    case POST;
}
