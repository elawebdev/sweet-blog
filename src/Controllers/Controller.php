<?php

declare(strict_types=1);

namespace SweetBlog\Controllers;

use SweetBlog\Core\Database\DatabaseHandler;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\View;

interface Controller
{
    public function __construct(DatabaseHandler $databaseHandler, View $view);

    public function run(): Response;
}
