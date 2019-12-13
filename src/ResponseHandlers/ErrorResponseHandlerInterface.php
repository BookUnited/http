<?php

namespace BookUnited\Http\ResponseHandlers;

use GuzzleHttp\Exception\ClientException;

interface ErrorResponseHandlerInterface
{
    /**
     * @param ClientException $clientException
     */
    public function handle(ClientException $clientException): void;
}