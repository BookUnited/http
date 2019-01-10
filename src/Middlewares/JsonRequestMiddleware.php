<?php

namespace BookUnited\Http\Middlewares;

use Psr\Http\Message\RequestInterface;

class JsonRequestMiddleware implements MiddlewareInterface
{
    /**
     * @inheritdoc
     */
    public function handle(RequestInterface $request): RequestInterface
    {
        return $request
            ->withAddedHeader('Content-Type', 'application/json')
            ->withAddedHeader('Accept', 'application/json');
    }
}