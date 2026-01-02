<?php

declare(strict_types=1);

namespace Tests\Core\Routing;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;
use SweetBlog\Controllers\HomeController;
use SweetBlog\Core\Http\Request;
use SweetBlog\Core\Routing\RouteNotFoundException;
use SweetBlog\Core\Routing\Router;
use SweetBlog\Core\Routing\Routes;

#[CoversClass(Router::class)]
final class RouterTest extends TestCase
{
    public static function matchingRouteProvider(): \Generator
    {
        yield ['GET', '/', HomeController::class];
        yield ['HEAD', '/', HomeController::class];
    }

    public static function noMatchingRouteProvider(): \Generator
    {
        yield ['GET', '/non-existent'];
        yield ['POST', '/'];
    }

    #[DataProvider('matchingRouteProvider')]
    public function testReturnsControllerClassOnMatchingRoute(
        string $method,
        string $uri,
        string $expectedController,
    ): void {
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $uri;

        $routes = new Routes();
        $request = new Request();
        $router = new Router($routes, $request);
        $controller = $router->match();

        $this->assertSame($expectedController, $controller);
    }

    #[DataProvider('noMatchingRouteProvider')]
    public function testThrowsExceptionIfNoMatchingRouteFound(string $method, string $uri): void
    {
        $_SERVER['REQUEST_METHOD'] = $method;
        $_SERVER['REQUEST_URI'] = $uri;

        $this->expectException(RouteNotFoundException::class);

        $routes = new Routes();
        $request = new Request();
        $router = new Router($routes, $request);
        $router->match();
    }
}
