<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

use SweetBlog\Controllers\HomeController;
use SweetBlog\Core\Database\DatabaseHandler;
use SweetBlog\Core\View;

final readonly class Kernel
{
    public function __construct(
        private DatabaseHandler $databaseHandler,
        private View $view,
    ) {}

    public function run(): Response
    {
        $controllerInstance = new HomeController($this->databaseHandler, $this->view);

        return $controllerInstance->run();
    }
}
