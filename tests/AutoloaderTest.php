<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DoesNotPerformAssertions;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use SweetBlog\Autoloader;
use Tests\Fixtures\AutoloaderTest\NotWithinSweetBlogNamespace;

#[CoversClass(Autoloader::class)]
#[RunTestsInSeparateProcesses]
final class AutoloaderTest extends TestCase
{
    private const string TEST_BASE_DIRECTORY = __DIR__ . DIRECTORY_SEPARATOR . 'Fixtures';

    #[TestWith(['/non/existent/directory'])]
    #[TestWith([self::TEST_BASE_DIRECTORY . '/AutoloaderTest/not-a-directory'])]
    public function testThrowsExceptionOnMissingBaseDirectory(string $path): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Missing base directory "%s".', $path));

        new Autoloader($path);
    }

    public function testCanBeRegistered(): void
    {
        $autoloader = new Autoloader(self::TEST_BASE_DIRECTORY);
        $autoloader->register();

        $this->assertContains([$autoloader, 'loadClass'], spl_autoload_functions());
        $this->assertTrue(spl_autoload_unregister([$autoloader, 'loadClass']));
    }

    #[TestWith([\SweetBlog\AutoloaderTest\WithinSweetBlogNamespace::class])]
    public function testCanLoadClassFromBaseDirectory(string $fullyQualifiedClassName): void
    {
        $autoloader = new Autoloader(self::TEST_BASE_DIRECTORY);
        $autoloader->loadClass($fullyQualifiedClassName);

        $this->assertTrue(class_exists($fullyQualifiedClassName, false));
    }

    #[TestWith([NotWithinSweetBlogNamespace::class])]
    public function testIgnoresClassNotWithinNamespace(string $fullyQualifiedClassName): void
    {
        $autoloader = new Autoloader(self::TEST_BASE_DIRECTORY);
        $autoloader->loadClass($fullyQualifiedClassName);

        $this->assertFalse(class_exists($fullyQualifiedClassName, false));
    }

    #[DoesNotPerformAssertions]
    public function testFailsSilentOnNonExistentClassFile(): void
    {
        // @phpstan-ignore class.notFound
        new Autoloader(self::TEST_BASE_DIRECTORY)->loadClass(\SweetBlog\NonExistent::class);
    }
}
