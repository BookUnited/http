<?php

namespace BookUnited\Http\Tests\ResponseHandlers;

use BookUnited\Http\Exceptions\ClientException;
use BookUnited\Http\ResponseHandlers\ErrorResponseHandler;
use BookUnited\Http\Exceptions\ValidationException;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;

class ErrorResponseHandlerTest extends TestCase
{
    public function testInvalidResponse(): void
    {
        $this->expectException(ClientException::class);

        $response = new GuzzleClientException(
            'Server error',
            new Request('GET', '/'),
            new Response(500)
        );

        $handler = new ErrorResponseHandler();
        $handler->handle($response);
    }

    public function testValidationResponse(): void
    {
        $body = [
            'errors' => [
                'name' => [
                    'Invalid name given'
                ],
            ],
        ];

        $response = new GuzzleClientException(
            'Validation error',
            new Request('POST', '/'),
            new Response(422, [], json_encode($body))
        );

        $handler = new ErrorResponseHandler();

        try {
            $handler->handle($response);
        } catch (ValidationException $e) {
            $this->assertInstanceOf(ValidationException::class, $e);
            $this->assertEquals($body, $e->getErrors());
        }
    }
}