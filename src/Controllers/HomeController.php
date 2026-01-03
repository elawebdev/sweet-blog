<?php

declare(strict_types=1);

namespace SweetBlog\Controllers;

use SweetBlog\Core\Database\DatabaseHandler;
use SweetBlog\Core\Http\Body;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Http\StatusCode;
use SweetBlog\Core\View;
use SweetBlog\Core\ViewData\HomeData;

final readonly class HomeController implements Controller
{
    public function __construct(
        private DatabaseHandler $databaseHandler,
        private View $view,
    ) {}

    public function run(): Response
    {
        $viewData = new HomeData(title: 'Sweet Blog');

        $content = $this->view->render('home', $viewData);

        $body = new Body($content);

        return new Response($body, StatusCode::Ok);
    }
}
