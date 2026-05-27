<?php

declare(strict_types=1);

namespace SweetBlog\Core;

use SweetBlog\Core\Http\Response;

/**
 * To be implemented by all handler classes.
 */
interface Handler
{
    public function execute(): Response;
}
