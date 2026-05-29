<?php

declare(strict_types=1);

namespace SweetBlog\Core\Dotenv;

use SweetBlog\Core\Dotenv\Exceptions\ReadFileException;

/**
 * Parses the .env file and assigns the values to environment variables.
 */
final class DotenvParser
{
    public function parse(string $dotenvFile): void
    {
        if (!file_exists($dotenvFile)) {
            return;
        }

        $lines = file($dotenvFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        if ($lines === false) {
            throw new ReadFileException(sprintf('Failed to read file %s.', $dotenvFile));
        }

        foreach ($lines as $line) {
            if (str_starts_with($line, '#')) {
                continue;
            }

            if (preg_match('/^([A-Z_]+)=(\S+)$/', $line) !== 1) {
                continue;
            }

            putenv($line);
        }
    }
}
