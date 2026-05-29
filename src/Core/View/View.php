<?php

declare(strict_types=1);

namespace SweetBlog\Core\View;

use SweetBlog\Core\View\Exceptions\MissingTemplateFileException;
use SweetBlog\Core\View\Exceptions\OutputBufferException;

final readonly class View
{
    public function __construct(
        private string $templateDirectory,
    ) {}

    public function render(string $template): string
    {
        $templateFile = "$this->templateDirectory/$template.php";

        if (!file_exists($templateFile)) {
            throw new MissingTemplateFileException($template);
        }

        ob_start();
        require $templateFile;
        $outputBufferContent = ob_get_clean();

        if ($outputBufferContent === false) {
            throw new OutputBufferException('Error while getting output buffer content.');
        }

        return $outputBufferContent;
    }
}
