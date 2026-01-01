<?php

declare(strict_types=1);

namespace SweetBlog\Core\Database;

use PDO;

final class DatabaseHandler
{
    public private(set) ?\PDO $pdoInstance = null;

    private readonly string $dsn;

    /**
     * @var array<int, mixed>
     */
    private readonly array $options;

    public function __construct(
        private readonly DatabaseCredentials $databaseCredentials = new DatabaseCredentials(),
    ) {
        $this->dsn = sprintf(
            'mysql:host=%s;port=%d;dbname=%s;charset=%s',
            $this->databaseCredentials->host,
            $this->databaseCredentials->port,
            $this->databaseCredentials->databaseName,
            $this->databaseCredentials->charset,
        );

        $this->options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
    }

    public function connect(): void
    {
        if ($this->pdoInstance !== null) {
            return;
        }

        $this->pdoInstance = new PDO(
            $this->dsn,
            $this->databaseCredentials->user,
            $this->databaseCredentials->password,
            $this->options,
        );
    }
}
