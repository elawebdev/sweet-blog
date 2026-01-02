<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

use SweetBlog\Controllers\Controller;
use SweetBlog\Controllers\NotFoundController;
use SweetBlog\Core\Database\DatabaseHandler;
use SweetBlog\Core\Routing\RouteNotFoundException;
use SweetBlog\Core\Routing\Router;
use SweetBlog\Core\Routing\Routes;
use SweetBlog\Core\View;

final readonly class Kernel
{
    public function __construct(
        private DatabaseHandler $databaseHandler,
        private View $view,
    ) {}

    public function run(): Response
    {
        $request = new Request();
        $routes = new Routes();
        $router = new Router($routes, $request);

        try {
            $controllerClass = $router->match();
        } catch (RouteNotFoundException) {
            $controllerClass = NotFoundController::class;
        }

        if (!class_exists($controllerClass)) {
            throw new \LogicException(sprintf('Missing controller class: %s', $controllerClass));
        }

        $controllerInstance = new $controllerClass($this->databaseHandler, $this->view);

        if (!$controllerInstance instanceof Controller) {
            throw new \LogicException(sprintf('Controller class must implement "%s"', Controller::class));
        }

        return $controllerInstance->run();
    }
}
