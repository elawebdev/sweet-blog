<?php

declare(strict_types=1);

namespace SweetBlog\Controllers;

use SweetBlog\Core\Database\DatabaseHandler;
use SweetBlog\Core\Http\Body;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Http\StatusCode;
use SweetBlog\Core\View;
use SweetBlog\Core\ViewData\NotFoundData;

final readonly class NotFoundController implements Controller
{
    public function __construct(
        private DatabaseHandler $databaseHandler,
        private View $view,
    ) {}

    public function run(): Response
    {
        $viewData = new NotFoundData(title: '404 NOT FOUND', message: 'The requested content could not be found.');

        $content = $this->view->render('not-found', $viewData);

        $body = new Body($content);

        return new Response($body, StatusCode::NotFound);
    }
}
