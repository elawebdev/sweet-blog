<?php

declare(strict_types=1);

namespace Tests\Core\Database;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use PHPUnit\Framework\TestCase;
use SweetBlog\Core\Database\DatabaseCredentials;

#[CoversClass(DatabaseCredentials::class)]
#[RunTestsInSeparateProcesses]
final class DatabaseCredentialsTest extends TestCase
{
    protected function setUp(): void
    {
        putenv('DATABASE_HOST=test_host');
        putenv('DATABASE_PORT=42');
        putenv('DATABASE_NAME=test_dbname');
        putenv('DATABASE_CHARSET=test_charset');
        putenv('DATABASE_USER=test_user');
        putenv('DATABASE_PASSWORD=test_password');

        parent::setUp();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        putenv('DATABASE_HOST');
        putenv('DATABASE_PORT');
        putenv('DATABASE_NAME');
        putenv('DATABASE_CHARSET');
        putenv('DATABASE_USER');
        putenv('DATABASE_PASSWORD');
    }

    public function testCanSetDatabaseCredentialsFromEnvironmentVariables(): void
    {
        $databaseCredentials = new DatabaseCredentials();

        $this->assertSame('test_host', $databaseCredentials->host);
        $this->assertSame('42', $databaseCredentials->port);
        $this->assertSame('test_dbname', $databaseCredentials->databaseName);
        $this->assertSame('test_charset', $databaseCredentials->charset);
        $this->assertSame('test_user', $databaseCredentials->user);
        $this->assertSame('test_password', $databaseCredentials->password);
    }
}
