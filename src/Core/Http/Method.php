<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

enum Method: string
{
    case Get = 'GET';
    case Head = 'HEAD';
    case Post = 'POST';
}
