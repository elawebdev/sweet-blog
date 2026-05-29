<?php

declare(strict_types=1);

namespace SweetBlog;

use SweetBlog\Core\Container\Container;
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
        $container = new Container();

        try {
            $handler = new Resolver()->match();
            $response = new Dispatcher($container)->dispatch($handler);
            $response->send();
        } catch (RouteNotFoundException) {
            http_response_code(StatusCode::NotFound->value);
            echo '404 Not Found';
        }
    }
}
