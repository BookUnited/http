<?php

namespace BookUnited\Http\Middlewares;

use Psr\Http\Message\RequestInterface;

class JsonRequestMiddleware implements MiddlewareInterface
{
    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): void
    {
        $request->withHeader('Content-Type', 'application/json');
        $request->withHeader('Accept', 'application/json');
    }
}