<?php

namespace BookUnited\Http;

interface ClientInterface
{
    /**
     * @param string $uri
     * @param array $parameters
     * @return array
     */
    public function get(string $uri, array $parameters = []): array;

    /**
     * @param string $uri
     * @param array $parameters
     * @return array
     */
    public function post(string $uri, array $parameters = []): array
}