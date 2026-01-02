<?php

declare(strict_types=1);

namespace SweetBlog\Core\Routing;

use SweetBlog\Controllers;
use SweetBlog\Core\Http\Method;

final readonly class Routes
{
    /**
     * @var list<array{0: Method, 1: string, 2: class-string}>
     */
    public private(set) array $routeList;

    public function __construct()
    {
        $this->routeList = [
            [Method::Get, '/', Controllers\HomeController::class],
            [Method::Head, '/', Controllers\HomeController::class],
        ];
    }
}
