<?php

namespace BookUnited\Http\Tests\Middlewares;

use BookUnited\Http\Client;
use BookUnited\Http\Middlewares\JsonRequestMiddleware;
use GuzzleHttp\Psr7\Request;
use PHPUnit\Framework\TestCase;

class JsonRequestMiddlewareTest extends TestCase
{
    public function testMiddleware(): void
    {
        $request = new Request(Client::GET, '/test-uri');

        $middleware = new JsonRequestMiddleware();
        $request = $middleware->handle($request);

        $this->assertEquals('application/json', $request->getHeaderLine('Accept'));
    }
}