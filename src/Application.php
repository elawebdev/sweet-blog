<?php

declare(strict_types=1);

namespace SweetBlog;

use SweetBlog\Core\Http\Body;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Http\StatusCode;

/**
 * Initializes and runs the application.
 */
final class Application
{
    public function run(): void
    {
        $content = 'Hello, world!';

        $body = new Body($content);
        $response = new Response($body, StatusCode::OK);
        $response->send();
    }
}
