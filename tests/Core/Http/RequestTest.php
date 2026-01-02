<?php

declare(strict_types=1);

namespace Tests\Core\Http;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\RunTestsInSeparateProcesses;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use SweetBlog\Core\Http\Request;

#[RunTestsInSeparateProcesses]
#[CoversClass(Request::class)]
final class RequestTest extends TestCase
{
    #[TestWith(['GET', '/test-get'])]
    #[TestWith(['HEAD', '/test-head'])]
    #[TestWith(['POST', '/test-post'])]
    public function testCanReturnRequestInformation(string $method, string $uri): void
    {
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $uri;

        $request = new Request();

        self::assertSame($method, $request->method);
        self::assertSame($uri, $request->uri);
    }

    public function testThrowsExceptionOnMissingRequestMethod(): void
    {
        $this->expectExceptionMessage(\RuntimeException::class);
        $this->expectExceptionMessage('No value found for key "REQUEST_METHOD".');

        // @phpstan-ignore expr.resultUnused
        new Request()->method;
    }

    public function testThrowsExceptionOnMissingRequestUri(): void
    {
        $this->expectExceptionMessage(\RuntimeException::class);
        $this->expectExceptionMessage('No value found for key "REQUEST_URI".');

        // @phpstan-ignore expr.resultUnused
        new Request()->uri;
    }

    public function testThrowsExceptionIfRequestMethodIsWrongType(): void
    {
        $_SERVER['REQUEST_METHOD'] = 42;

        $this->expectExceptionMessage(\RuntimeException::class);
        $this->expectExceptionMessage('Expected a string value for key "REQUEST_METHOD".');

        $this->assertNotEmpty(new Request()->method);
    }

    public function testThrowsExceptionIfRequestUriIsWrongType(): void
    {
        $_SERVER['REQUEST_URI'] = 42;

        $this->expectExceptionMessage(\RuntimeException::class);
        $this->expectExceptionMessage('Expected a string value for key "REQUEST_URI".');

        $this->assertNotEmpty(new Request()->uri);
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
    }
}
