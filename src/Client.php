<?php

namespace BookUnited\Http;

use BookUnited\Http\Middlewares\MiddlewareInterface;
use BookUnited\Http\ResponseHandlers\ErrorResponseHandlerInterface;
use BookUnited\Http\ResponseHandlers\ResponseHandlerInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Client as HttpClient;

class Client implements ClientInterface
{
    const GET = 'GET';

    const POST = 'POST';

    /** @var HttpClient */
    protected $httpClient;

    /** @var MiddlewareInterface[] */
    protected $middlewares = [];

    /** @var ResponseHandlerInterface */
    protected $responseHandler;

    /** @var ErrorResponseHandlerInterface */
    protected $errorResponseHandler;

    /**
     * @param string $endpoint
     * @param ResponseHandlerInterface $responseHandler
     * @param ErrorResponseHandlerInterface $errorResponseHandler
     * @param array $middlewares
     */
    public function __construct(
        string $endpoint,
        ResponseHandlerInterface $responseHandler,
        ErrorResponseHandlerInterface $errorResponseHandler,
        array $middlewares = []
    )
    {
        $this->httpClient = new \GuzzleHttp\Client([
            'base_uri' => $endpoint,
        ]);

        $this->responseHandler = $responseHandler;
        $this->errorResponseHandler = $errorResponseHandler;

        foreach ($middlewares as $middleware) {
            $this->addMiddleware($middleware);
        }
    }

    /**
     * @param MiddlewareInterface $middleware
     */
    public function addMiddleware(MiddlewareInterface $middleware): void
    {
        $this->middlewares[] = $middleware;
    }

    /**
     * @inheritdoc
     */
    public function get(string $uri, array $parameters = []): array
    {
        return $this->request(self::GET, $uri, [], ['query' => $parameters]);
    }

    /**
     * @inheritdoc
     */
    public function post(string $uri, array $parameters = []): array
    {
        return $this->request(self::POST, $uri, [], [
            'form_params' => $parameters,
        ]);
    }

    /**
     * @param string $method
     * @param string $uri
     * @param array $headers
     * @param array $options
     * @return array
     */
    private function request(string $method, string $uri, array $headers = [], array $options = []): array
    {
        $request = new Request($method, $uri, $headers);

        foreach ($this->middlewares as $middleware) {
            $middleware->handle($request);
        }

        try {
            $response = $this->httpClient->send($request, $options);
            return $this->responseHandler->handle($response);
        } catch (ClientException $e) {
            $this->errorResponseHandler->handle($e->getResponse());
        }
    }
}