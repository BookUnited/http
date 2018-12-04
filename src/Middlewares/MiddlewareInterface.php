<?php

namespace BookUnited\Http\Middlewares;

use Psr\Http\Message\RequestInterface;

interface MiddlewareInterface
{
    /**
     * @param RequestInterface $request
     */
    public function handle(RequestInterface $request): void;
}