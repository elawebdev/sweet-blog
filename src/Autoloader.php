<?php

declare(strict_types=1);

namespace SweetBlog;

use InvalidArgumentException;

/**
 * The autoloader follows the PSR-4 specification to be compatible with Composer's autoloader.
 *
 * @see https://www.php-fig.org/psr/psr-4/
 */
final readonly class Autoloader
{
    private const string NAMESPACE_SEPARATOR = '\\';
    private const string NAMESPACE_PREFIX = __NAMESPACE__ . self::NAMESPACE_SEPARATOR;
    private const string FILE_EXTENSION = '.php';

    public function __construct(
        private string $baseDirectory = __DIR__,
    ) {
        $this->checkBaseDirectoryPath();
    }

    public function loadClass(string $fullyQualifiedClassName): void
    {
        if (!$this->isWithinNamespace($fullyQualifiedClassName)) {
            return;
        }

        $relativeClassName = $this->removeNamespacePrefix($fullyQualifiedClassName);

        $classFilePath = $this->getPathFromNamespace($relativeClassName);

        if (file_exists($classFilePath)) {
            require $classFilePath;
        }
    }

    public function register(): void
    {
        spl_autoload_register([$this, 'loadClass']);
    }

    private function checkBaseDirectoryPath(): void
    {
        if (!is_dir($this->baseDirectory)) {
            throw new InvalidArgumentException(sprintf('Missing base directory "%s".', $this->baseDirectory));
        }
    }

    private function getPathFromNamespace(string $relativeClassName): string
    {
        return (
            $this->baseDirectory
            . DIRECTORY_SEPARATOR
            . str_replace(self::NAMESPACE_SEPARATOR, DIRECTORY_SEPARATOR, $relativeClassName)
            . self::FILE_EXTENSION
        );
    }

    private function isWithinNamespace(string $fullyQualifiedClassName): bool
    {
        return str_starts_with($fullyQualifiedClassName, self::NAMESPACE_PREFIX);
    }

    private function removeNamespacePrefix(string $fullyQualifiedClassName): string
    {
        return substr($fullyQualifiedClassName, strlen(self::NAMESPACE_PREFIX));
    }
}
