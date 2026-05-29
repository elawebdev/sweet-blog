<?php

declare(strict_types=1);

namespace SweetBlog\Core\Database;

use SweetBlog\Core\Database\Exceptions\MissingEnvironmentVariableException;

/**
 * Database credentials.
 */
final readonly class DatabaseConfig
{
    public string $host;
    public string $port;
    public string $dbname;
    public string $charset;
    public string $user;
    public string $password;

    public function __construct()
    {
        $this->host = $this->getEnvValue('DB_HOST');
        $this->port = $this->getEnvValue('DB_PORT');
        $this->dbname = $this->getEnvValue('DB_NAME');
        $this->charset = $this->getEnvValue('DB_CHARSET');
        $this->user = $this->getEnvValue('DB_USER');
        $this->password = $this->getEnvValue('DB_PASSWORD');
    }

    public function getEnvValue(string $name): string
    {
        $value = getenv($name);

        if ($value === false) {
            throw new MissingEnvironmentVariableException($name);
        }

        return $value;
    }
}
