<?php

declare(strict_types=1);

namespace SweetBlog\Core\Utils;

use SweetBlog\Core\Utils\Exceptions\SlugException;

final class Slug
{
    public static function generate(string $requestUri): string
    {
        $urlPath = parse_url($requestUri, PHP_URL_PATH);

        if ($urlPath === false || $urlPath === null) {
            throw new SlugException('Failed to parse URL path.');
        }

        $segments = explode('/', $urlPath);

        return array_pop($segments);
    }
}
