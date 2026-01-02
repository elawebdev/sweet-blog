<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

enum StatusCode: int
{
    case Ok = 200;
    case NotFound = 404;
}
