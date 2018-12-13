<?php

namespace BookUnited\Http\Middlewares;

use Psr\Http\Message\RequestInterface;

interface MiddlewareInterface
{
    /**
     * @param RequestInterface $request
     * @return RequestInterface
     */
    public function handle(RequestInterface $request): RequestInterface;
}