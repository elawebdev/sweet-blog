<?php

declare(strict_types=1);

namespace SweetBlog\Handlers;

use SweetBlog\Core\Http\Body;
use SweetBlog\Core\Http\Request;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Http\StatusCode;
use SweetBlog\Core\Utils\Slug;
use SweetBlog\Core\View\View;
use SweetBlog\DTOs\PostData;
use SweetBlog\Repositories\PostRepository;


/**
 * Post page handler.
 */
final readonly class PostHandler implements Handler
{
    public function __construct(
        private View $view,
        private PostRepository $postRepository,
        private Request $request,
    ) {}

    public function execute(): Response
    {
        $slug = Slug::generate($this->request->uri);

        $post = $this->postRepository->fetchPost($slug);

        if ($post === false) {
            return new Response(new Body('Post not found.'), StatusCode::NotFound);
        }

        $data = new PostData(
            title: $post->title,
            content: $post->content,
            author: $post->handle,
            createdAt: $post->created_at,
        );

        $content = $this->view->render('post', $data);

        $body = new Body($content);
        return new Response($body, StatusCode::OK);
    }
}
