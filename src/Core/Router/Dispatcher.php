<?php

declare(strict_types=1);

namespace SweetBlog\Core\Router;

use SweetBlog\Core\Container\Container;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Router\Exceptions\MissingHandlerClassFileException;
use SweetBlog\Core\Router\Exceptions\MissingHandlerInterfaceException;
use SweetBlog\Handlers\Handler;

/**
 * Invokes the given handler.
 */
final readonly class Dispatcher
{
    public function __construct(
        private Container $container,
    ) {}

    public function dispatch(string $handler): Response
    {
        if (!class_exists($handler)) {
            throw new MissingHandlerClassFileException($handler);
        }

        if (!is_subclass_of($handler, Handler::class)) {
            throw new MissingHandlerInterfaceException($handler);
        }

        $handlerInstance = $this->container->make($handler);

        return $handlerInstance->execute();
    }
}
