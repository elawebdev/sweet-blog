<?php

declare(strict_types=1);

namespace SweetBlog\Core\Router;

use SweetBlog\Core\Http\Request;
use SweetBlog\Core\Router\Exceptions\RouteNotFoundException;

/**
 * Resolves a request to the appropriate handler.
 */
final readonly class Resolver
{
    public function __construct(
        private Routes $routes = new Routes(),
        private Request $request = new Request(),
    ) {}

    /**
     * Matches the request to a route and returns the handler class name.
     *
     * @return string Handler class name
     * @throws RouteNotFoundException if no matching route is found
     */
    public function match(): string
    {
        foreach ($this->routes->routeList as $route) {
            if ($this->request->method !== $route->method->name) {
                continue;
            }

            if (preg_match($route->pattern, $this->request->uri) !== 1) {
                continue;
            }

            return $route->handler;
        }

        throw new RouteNotFoundException();
    }
}
