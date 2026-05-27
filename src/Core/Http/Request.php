<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

use SweetBlog\Core\Http\Exceptions\InvalidTypeException;
use SweetBlog\Core\Http\Exceptions\MissingSuperglobalServerEntryException;

/**
 * HTTP request information.
 */
final readonly class Request
{
    public string $method;
    public string $uri;

    public function __construct()
    {
        $this->method = $this->getFromSuperGlobalServer('REQUEST_METHOD');
        $this->uri = $this->getFromSuperGlobalServer('REQUEST_URI');
    }

    private function getFromSuperGlobalServer(string $key): string
    {
        if (!array_key_exists($key, $_SERVER)) {
            throw new MissingSuperglobalServerEntryException($key);
        }

        if (!is_string($_SERVER[$key])) {
            throw new InvalidTypeException($key);
        }

        return $_SERVER[$key];
    }
}
