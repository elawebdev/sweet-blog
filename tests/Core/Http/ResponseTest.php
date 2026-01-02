<?php

declare(strict_types=1);

namespace Tests\Core\Http;

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\TestWith;
use PHPUnit\Framework\TestCase;
use SweetBlog\Core\Http\Body;
use SweetBlog\Core\Http\Response;
use SweetBlog\Core\Http\StatusCode;

#[CoversClass(Response::class)]
final class ResponseTest extends TestCase
{
    #[TestWith(['ok', StatusCode::Ok])]
    #[TestWith(['not found', StatusCode::NotFound])]
    public function testCanSendHttpResponse(string $bodyContent, StatusCode $statusCode): void
    {
        $body = new Body($bodyContent);

        $response = new Response($body, $statusCode);
        $response->send();

        $this->expectOutputString($bodyContent);
        $this->assertSame($statusCode->value, http_response_code());
    }
}
