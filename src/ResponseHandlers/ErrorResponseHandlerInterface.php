<?php

namespace BookUnited\Http\ResponseHandlers;

use BookUnited\Http\ClientException;
use Psr\Http\Message\ResponseInterface;

interface ErrorResponseHandlerInterface
{
    /**
     * @param ResponseInterface $response
     * @return void
     * @throws ClientException
     */
    public function handle(ResponseInterface $response): void;
}