<?php

declare(strict_types=1);

namespace SweetBlog\Core\Router;

use SweetBlog\Core\Container\Container;
use SweetBlog\Core\Handler;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Router\Exceptions\MissingHandlerClassFileException;
use SweetBlog\Core\Router\Exceptions\MissingHandlerInterfaceException;

/**
 * Invokes the given handler.
 */
final readonly class Dispatcher
{
    public function __construct(
        private string $handler,
        private Container $container,
    ) {
        if (!class_exists($this->handler)) {
            throw new MissingHandlerClassFileException($handler);
        }

        if (!is_subclass_of($this->handler, Handler::class)) {
            throw new MissingHandlerInterfaceException($handler);
        }
    }

    public function dispatch(): Response
    {
        $handlerInstance = $this->container->make($this->handler);

        return $handlerInstance->execute();
    }
}
