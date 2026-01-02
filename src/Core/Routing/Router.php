<?php

declare(strict_types=1);

namespace SweetBlog\Core\Routing;

use SweetBlog\Core\Http\Request;

final readonly class Router
{
    public function __construct(
        private Routes $routes,
        private Request $request,
    ) {}

    /**
     * @throws \SweetBlog\Core\Routing\RouteNotFoundException if no matching route exists
     */
    public function match(): string
    {
        foreach ($this->routes->routeList as $route) {
            [$method, $pattern, $controller] = $route;

            if ($method->value !== $this->request->method) {
                continue;
            }

            if (preg_match("#^$pattern$#", $this->request->uri) !== 1) {
                continue;
            }

            return $controller;
        }

        throw new RouteNotFoundException();
    }
}
