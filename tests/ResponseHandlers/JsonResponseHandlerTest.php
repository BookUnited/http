<?php

namespace BookUnited\Http\Tests\ResponseHandlers;

use BookUnited\Http\ResponseHandlers\JsonResponseHandler;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class JsonResponseHandlerTest extends TestCase
{
    public function testResponse(): void
    {
        $response = new Response(200, [], '{"json":"content"}');

        $handler = new JsonResponseHandler();
        $result = $handler->handle($response);

        $this->assertEquals([
            'json' => 'content',
        ], $result);
    }
}