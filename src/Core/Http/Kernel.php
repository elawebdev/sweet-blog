<?php

declare(strict_types=1);

namespace SweetBlog\Core\Http;

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
        $content = $this->view->render('home');

        $body = new Body($content);

        return new Response($body, StatusCode::Ok);
    }
}
