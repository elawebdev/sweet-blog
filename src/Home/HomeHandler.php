<?php

declare(strict_types=1);

namespace SweetBlog\Home;

use SweetBlog\Core\Handler;
use SweetBlog\Core\Http\Body;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Http\StatusCode;
use SweetBlog\Core\View\View;

/**
 * Home page handler.
 */
final readonly class HomeHandler implements Handler
{
    public function __construct(
        private View $view,
    ) {}

    public function execute(): Response
    {
        $data = new HomeData(
            title: 'Home Page',
        );

        $content = $this->view->render('home', $data);

        $body = new Body($content);

        return new Response($body, StatusCode::OK);
    }
}
