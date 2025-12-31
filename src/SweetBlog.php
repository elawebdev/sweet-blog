<?php

declare(strict_types=1);

namespace SweetBlog;

use SweetBlog\Core\View;

final readonly class SweetBlog
{
    public function __construct(
        private string $rootDirectory,
    ) {
        $this->checkRootDirectoryPath();
    }

    public function init(): void
    {
        $view = new View($this->rootDirectory . '/views');

        echo 'Hello, world!';
    }

    private function checkRootDirectoryPath(): void
    {
        if (!is_dir($this->rootDirectory)) {
            throw new \InvalidArgumentException(sprintf('Missing root directory "%s".', $this->rootDirectory));
        }
    }
}
