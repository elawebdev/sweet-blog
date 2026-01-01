<?php

declare(strict_types=1);

namespace SweetBlog\Core\Database;

final readonly class DatabaseCredentials
{
    public private(set) string $host;
    public private(set) string $port;
    public private(set) string $databaseName;
    public private(set) string $charset;
    public private(set) string $user;
    public private(set) string $password;

    public function __construct()
    {
        $this->host = getenv('DATABASE_HOST') ?: 'localhost';
        $this->port = getenv('DATABASE_PORT') ?: '3306';
        $this->databaseName = getenv('DATABASE_NAME') ?: '';
        $this->charset = getenv('DATABASE_CHARSET') ?: 'utf8mb4';
        $this->user = getenv('DATABASE_USER') ?: '';
        $this->password = getenv('DATABASE_PASSWORD') ?: '';
    }
}
