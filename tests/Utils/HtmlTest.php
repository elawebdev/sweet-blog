<?php

declare(strict_types=1);

namespace Tests\Utils;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use SweetBlog\Utils\Html;

#[CoversClass(Html::class)]
final class HtmlTest extends TestCase
{
    public static function htmlStringProvider(): \Generator
    {
        yield ['<script>alert(1)</script>', '&lt;script&gt;alert(1)&lt;/script&gt;'];
        yield ['<a href="#">Test</a>', '&lt;a href=&quot;#&quot;&gt;Test&lt;/a&gt;'];
        yield ["'test'", '&apos;test&apos;'];
        yield ['black & white', 'black &amp; white'];
    }

    #[DataProvider('htmlStringProvider')]
    public function testEscapesHtmlSpecificCharacters(string $actual, string $expected): void
    {
        $this->assertSame($expected, Html::escape($actual));
    }
}
