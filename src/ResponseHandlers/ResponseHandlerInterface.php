<?php

namespace BookUnited\Http\ResponseHandlers;

use Psr\Http\Message\ResponseInterface;

interface ResponseHandlerInterface
{
    /**
     * @param ResponseInterface $response
     * @return array
     */
    public function handle(ResponseInterface $response): array;
}