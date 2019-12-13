<?php

namespace BookUnited\Http\ResponseHandlers;

use BookUnited\Http\Exceptions\ClientException;
use BookUnited\Http\Exceptions\ValidationException;
use GuzzleHttp\Exception\ClientException as GuzzleClientException;

class ErrorResponseHandler implements ErrorResponseHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(GuzzleClientException $clientException): void
    {
        $errors = json_decode($clientException->getResponse()->getBody()->getContents(), true);

        if ($clientException->getResponse()->getStatusCode() === 422) {
            throw new ValidationException('Validation errors', 422, $errors);
        }

        throw new ClientException($clientException->getMessage(), $clientException->getCode());
    }
}