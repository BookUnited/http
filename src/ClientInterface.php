<?php

namespace BookUnited\Http;

use BookUnited\Http\Middlewares\MiddlewareInterface;

interface ClientInterface
{
    /**
     * @param MiddlewareInterface $middleware
     */
    public function addMiddleware(MiddlewareInterface $middleware): void;

    /**
     * @param string $uri
     * @param array $parameters
     * @return array
     */
    public function get(string $uri, array $parameters = []): array;

    /**
     * @param string $uri
     * @param array $payload
     * @return array
     */
    public function post(string $uri, array $payload = []): array;
}