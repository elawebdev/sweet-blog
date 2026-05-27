<?php

declare(strict_types=1);

namespace SweetBlog;

use SweetBlog\Core\Http\StatusCode;
use SweetBlog\Core\Router\Dispatcher;
use SweetBlog\Core\Router\Exceptions\RouteNotFoundException;
use SweetBlog\Core\Router\Resolver;

/**
 * Initializes and runs the application.
 */
final class Application
{
    public function run(): void
    {
        try {
            $handler = new Resolver()->match();
            $response = new Dispatcher($handler)->dispatch();
            $response->send();
        } catch (RouteNotFoundException) {
            http_response_code(StatusCode::NotFound->value);
            echo '404 Not Found';
        }
    }
}
