<?php

declare(strict_types=1);

namespace SweetBlog\Core\Router;

use SweetBlog\Core\Http\Method;
use SweetBlog\Handlers;

/**
 * Collection of routes.
 */
final readonly class Routes
{
    /**
     * @var list<Route> List of registered routes
     */
    public array $routeList;

    /**
     * Initializes the route list.
     */
    public function __construct()
    {
        $this->routeList = [
            new Route(Method::GET, '#^/$#', Handlers\HomeHandler::class),
            new Route(Method::HEAD, '#^/$#', Handlers\HomeHandler::class),
            new Route(Method::GET, '#^/post/([A-Za-z0-9_\-\#]+)$#', Handlers\PostHandler::class),
            new Route(Method::HEAD, '#^/post/([A-Za-z0-9_\-\#]+)$#', Handlers\PostHandler::class),
        ];
    }
}
