<?php

declare(strict_types=1);

namespace Tests;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use SweetBlog\SweetBlog;

#[CoversClass(SweetBlog::class)]
final class SweetBlogTest extends TestCase
{
    #[TestWith(['/non/existent/directory'])]
    public function testThrowsExceptionOnMissingRootDirectory(string $path): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Missing root directory "%s".', $path));

        new SweetBlog($path);
    }
}
