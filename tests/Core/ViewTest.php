<?php

declare(strict_types=1);

namespace Tests\Core;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use SweetBlog\Core\View;
use Tests\Fixtures\ViewData\ViewTestData;

#[CoversClass(View::class)]
final class ViewTest extends TestCase
{
    private string $testViewsDirectory;

    protected function setUp(): void
    {
        $this->testViewsDirectory = dirname(__DIR__) . '/Fixtures/views';

        parent::setUp();
    }

    #[TestWith(['/non/existent/directory'])]
    public function testThrowsExceptionOnMissingViewsDirectory(string $path): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage(sprintf('Missing views directory "%s".', $path));

        new View($path);
    }

    #[TestWith(['non-existent'])]
    public function testThrowsExceptionOnMissingViewFile(string $viewFileName): void
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage(sprintf('Missing view file "%s".', $viewFileName));

        $viewData = new ViewTestData(title: '');

        new View($this->testViewsDirectory)->render($viewFileName, $viewData);
    }

    #[TestWith(['test_view'])]
    public function testCanRenderViewFile(string $viewFileName): void
    {
        $expectedContent = <<<HTML
        <!doctype html>
        <html lang="en">
        <head>
            <title>Test View</title>
            <meta charset="UTF-8">
        </head>
        <body>
        <h1>Test View</h1>
        <p>OK</p>
        </body>
        </html>
        HTML;

        $viewData = new ViewTestData(title: 'Test View');

        $view = new View($this->testViewsDirectory);
        $actualContent = $view->render($viewFileName, $viewData) |> trim(...);

        $this->assertSame($expectedContent, $actualContent);
    }
}
