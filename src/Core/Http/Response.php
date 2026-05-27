<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

/**
 * HTTP response.
 */
final readonly class Response
{
    public function __construct(
        public Body $body,
        public StatusCode $statusCode,
    ) {}

    /**
     * Sends the HTTP response to the client.
     */
    public function send(): void
    {
        http_response_code($this->statusCode->value);

        echo $this->body->content;
    }
}
