<?php

declare(strict_types=1);

namespace SweetBlog\Home;

use SweetBlog\Core\Handler;
use SweetBlog\Core\Http\Body;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Http\StatusCode;

/**
 * Home page handler.
 */
final class HomeHandler implements Handler
{
    public function execute(): Response
    {
        $content = 'Hello, world!';

        $body = new Body($content);

        return new Response($body, StatusCode::OK);
    }
}
