<?php

declare(strict_types=1);

namespace Tests\Core\Http;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use SweetBlog\Core\Http\Body;

#[CoversClass(Body::class)]
final class BodyTest extends TestCase
{
    #[TestWith(['ok'])]
    public function testCanSetBodyContent(string $content): void
    {
        $body = new Body($content);

        $this->assertSame($content, $body->content);
    }
}
