<?php

declare(strict_types=1);

namespace SweetBlog\Handlers;

use SweetBlog\Core\Http\Body;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Http\StatusCode;
use SweetBlog\Core\View\View;
use SweetBlog\Home\HomeData;
use SweetBlog\Repositories\PostListRepository;

/**
 * Home page handler.
 */
final readonly class HomeHandler implements Handler
{
    public function __construct(
        private View $view,
        private PostListRepository $postListRepository,
    ) {}

    public function execute(): Response
    {
        $postList = $this->postListRepository->fetchRecentPosts(limit: 10);

        $data = new HomeData(
            title: 'Home Page',
            postList: $postList,
        );

        $content = $this->view->render('home', $data);

        $body = new Body($content);

        return new Response($body, StatusCode::OK);
    }
}
