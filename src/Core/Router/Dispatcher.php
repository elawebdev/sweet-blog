<?php

declare(strict_types=1);

namespace SweetBlog\Core\Router;

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
        $handlerInstance = new $this->handler();

        return $handlerInstance->execute();
    }
}
