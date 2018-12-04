<?php

namespace BookUnited\Http\ResponseHandlers;

use BookUnited\Http\ClientException;
use Psr\Http\Message\ResponseInterface;

class ErrorResponseHandler implements ErrorResponseHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(ResponseInterface $response): void
    {
        $errors = json_decode($response->getBody()->getContents(), true);

        if ($response->getStatusCode() === 422) {
            throw new ClientException('Validation errors', $errors);
        }

        throw new ClientException('500 error! Something is very wrong!');
    }
}