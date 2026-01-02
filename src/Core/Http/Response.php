<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

final readonly class Response
{
    public function __construct(
        public Body $body = new Body(),
        public StatusCode $statusCode = StatusCode::Ok,
    ) {}

    public function send(): void
    {
        http_response_code($this->statusCode->value);

        echo $this->body->content;
    }
}
