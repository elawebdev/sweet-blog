<?php

declare(strict_types=1);

namespace SweetBlog\Controllers;

use SweetBlog\Core\Database\DatabaseHandler;
use SweetBlog\Core\Http\Body;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Http\StatusCode;
use SweetBlog\Core\View;

final readonly class HomeController implements Controller
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
