<?php

declare(strict_types=1);

namespace SweetBlog\Core\Router;

use SweetBlog\Core\Http\Method;
use SweetBlog\Home\HomeHandler;

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
            new Route(Method::GET, '#^/$#', HomeHandler::class),
            new Route(Method::HEAD, '#^/$#', HomeHandler::class),
        ];
    }
}
