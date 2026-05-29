<?php

declare(strict_types=1);

namespace SweetBlog\Core\Database;

use PDO;

/**
 * Establishes a connection to the database.
 */
final class Database
{
    public private(set) PDO $pdo;
    private readonly string $dsn;

    public function __construct(
        private readonly DatabaseConfig $config,
    ) {
        $this->dsn = sprintf(
            'mysql:host=%s;port=%s;dbname=%s;charset=%s',
            $this->config->host,
            $this->config->port,
            $this->config->dbname,
            $this->config->charset,
        );
    }

    public function connect(): void
    {
        $this->pdo = new PDO(
            $this->dsn,
            $this->config->user,
            $this->config->password,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ],
        );
    }
}
