<?php

declare(strict_types=1);

namespace SweetBlog;

use SweetBlog\Home\HomeHandler;

/**
 * Initializes and runs the application.
 */
final class Application
{
    public function run(): void
    {
        $response = new HomeHandler()->execute();
        $response->send();
    }
}
