<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

final class Request
{
    public string $uri {
        get => $this->getFromServer('REQUEST_URI');
    }

    public string $method {
        get => $this->getFromServer('REQUEST_METHOD');
    }

    public function getFromServer(string $key): string
    {
        if (!isset($_SERVER[$key])) {
            throw new \RuntimeException(sprintf('No value found for key "%s".', $key));
        }

        if (!is_string($_SERVER[$key])) {
            throw new \RuntimeException(sprintf('Expected a string value for key "%s".', $key));
        }

        return $_SERVER[$key];
    }
}
