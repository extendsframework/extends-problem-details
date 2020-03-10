<?php
declare(strict_types=1);

namespace ExtendsFramework\Problem\Framework\Http\Middleware;

use ExtendsFramework\Http\Middleware\Chain\MiddlewareChainInterface;
use ExtendsFramework\Http\Middleware\MiddlewareInterface;
use ExtendsFramework\Http\Request\RequestInterface;
use ExtendsFramework\Http\Response\ResponseInterface;
use ExtendsFramework\Problem\ProblemInterface;
use ExtendsFramework\Problem\Serializer\SerializerInterface;

class ProblemMiddleware implements MiddlewareInterface
{
    /**
     * Problem serializer.
     *
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * ProblemMiddleware constructor.
     *
     * @param SerializerInterface $serializer
     */
    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @inheritDoc
     */
    public function process(RequestInterface $request, MiddlewareChainInterface $chain): ResponseInterface
    {
        $response = $chain->proceed($request);
        $body = $response->getBody();
        if ($body instanceof ProblemInterface) {
            $serialized = $this->serializer->serialize($body);

            $response = $response
                ->withHeader('Content-Type', 'application/problem+json')
                ->withHeader('Content-Length', (string)strlen($serialized))
                ->withStatusCode($body->getStatus())
                ->withBody($serialized);
        }

        return $response;
    }
}
