<?php

namespace BookUnited\Http\ResponseHandlers;

use BookUnited\Http\Exceptions\ClientException;
use BookUnited\Http\Exceptions\ValidationException;
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
            throw new ValidationException('Validation errors', 422, $errors);
        }

        throw new ClientException($response->getBody()->getContents(), $response->getStatusCode());
    }
}