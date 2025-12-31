<?php

declare(strict_types=1);

namespace SweetBlog\Core;

final readonly class View
{
    const string FILE_EXTENSION = '.php';

    public function __construct(
        private string $viewsDirectory,
    ) {
        $this->checkViewsDirectoryPath();
    }

    public function render(string $viewFileName): string
    {
        $viewFile = $this->getViewFilePath($viewFileName);

        if (!file_exists($viewFile)) {
            throw new \LogicException(sprintf('Missing view file "%s".', $viewFileName));
        }

        $this->outputBufferStart();

        require $viewFile;

        return $this->outputBufferContent();
    }

    private function checkViewsDirectoryPath(): void
    {
        if (!is_dir($this->viewsDirectory)) {
            throw new \InvalidArgumentException(sprintf('Missing views directory "%s".', $this->viewsDirectory));
        }
    }

    private function getViewFilePath(string $viewFileName): string
    {
        return $this->viewsDirectory . DIRECTORY_SEPARATOR . basename($viewFileName) . self::FILE_EXTENSION;
    }

    private function outputBufferContent(): string
    {
        $content = ob_get_clean();

        if ($content === false) {
            throw new \RuntimeException('Failed to get output buffer content.');
        }

        return $content;
    }

    private function outputBufferStart(): void
    {
        if (!ob_start()) {
            throw new \RuntimeException('Failed to start output buffer');
        }
    }
}
