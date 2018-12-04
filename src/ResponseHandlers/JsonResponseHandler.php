<?php

namespace BookUnited\Http\ResponseHandlers;

use Psr\Http\Message\ResponseInterface;

class JsonResponseHandler implements ResponseHandlerInterface
{
    /**
     * @inheritdoc
     */
    public function handle(ResponseInterface $response): array
    {
        return json_decode($response->getBody()->getContents(), true);
    }
}