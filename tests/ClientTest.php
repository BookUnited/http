<?php

namespace BookUnited\Http\Tests;

use BookUnited\Http\Client;
use BookUnited\Http\ClientInterface;
use BookUnited\Http\Middlewares\JsonRequestMiddleware;
use BookUnited\Http\ResponseHandlers\ErrorResponseHandler;
use BookUnited\Http\ResponseHandlers\JsonResponseHandler;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $client = new Client(
            'https://some.endpoint.com/v1/',
            new JsonResponseHandler(),
            new ErrorResponseHandler(),
            [
                new JsonRequestMiddleware(),
            ]
        );

        $this->assertInstanceOf(ClientInterface::class, $client);
    }
}