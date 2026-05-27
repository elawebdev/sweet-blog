<?php

declare(strict_types=1);

namespace SweetBlog;

use InvalidArgumentException;

/**
 * Loads classes automatically on demand, following the PSR-4 specification.
 *
 * @see https://www.php-fig.org/psr/psr-4/
 */
final readonly class Autoloader
{
    public function __construct(
        private string $topLevelNamespace = __NAMESPACE__,
        private string $baseDirectory = __DIR__,
    ) {
        if ($this->topLevelNamespace === '') {
            throw new InvalidArgumentException('The top level namespace must not be empty.');
        }

        if ($this->baseDirectory === '') {
            throw new InvalidArgumentException('The base directory path must not be empty.');
        }

        if (!is_dir($this->baseDirectory)) {
            throw new InvalidArgumentException(sprintf('Invalid base directory path: %s', $this->baseDirectory));
        }
    }

    public function register(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    public function loadClass(string $fullyQualifiedClassname): void
    {
        if (!str_starts_with($fullyQualifiedClassname, "$this->topLevelNamespace\\")) {
            return;
        }

        $relativeClassName = substr($fullyQualifiedClassname, strlen("$this->topLevelNamespace\\"));
        $relativeClassPath = str_replace('\\', '/', $relativeClassName);
        $classFile = "$this->baseDirectory/$relativeClassPath.php";

        if (!file_exists($classFile)) {
            return;
        }

        require $classFile;
    }
}
