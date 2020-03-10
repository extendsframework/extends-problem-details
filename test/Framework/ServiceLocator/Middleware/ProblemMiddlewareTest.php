<?php
declare(strict_types=1);

namespace ExtendsFramework\Problem\Framework\Http\Middleware;

use ExtendsFramework\Http\Middleware\Chain\MiddlewareChainInterface;
use ExtendsFramework\Http\Request\RequestInterface;
use ExtendsFramework\Http\Response\ResponseInterface;
use ExtendsFramework\Problem\ProblemInterface;
use ExtendsFramework\Problem\Serializer\SerializerInterface;
use PHPUnit\Framework\TestCase;

class ProblemMiddlewareTest extends TestCase
{
    /**
     * Process.
     *
     * Test that middleware will serialize problem response body.
     *
     * @covers \ExtendsFramework\Problem\Framework\Http\Middleware\ProblemMiddleware::__construct()
     * @covers \ExtendsFramework\Problem\Framework\Http\Middleware\ProblemMiddleware::process
     */
    public function testProcess(): void
    {
        $problem = $this->createMock(ProblemInterface::class);

        $serializer = $this->createMock(SerializerInterface::class);
        $serializer
            ->expects($this->once())
            ->method('serialize')
            ->with($problem)
            ->willReturn('{"type":"/foo/bar}');

        $response = $this->createMock(ResponseInterface::class);
        $response
            ->expects($this->once())
            ->method('getBody')
            ->willReturn($problem);

        $response
            ->expects($this->exactly(2))
            ->method('withHeader')
            ->withConsecutive(
                ['Content-Type', 'application/problem+json'],
                ['Content-Length', '18']
            )
            ->willReturnSelf();

        $response
            ->expects($this->once())
            ->method('withBody')
            ->with('{"type":"/foo/bar}')
            ->willReturnSelf();

        $request = $this->createMock(RequestInterface::class);

        $chain = $this->createMock(MiddlewareChainInterface::class);
        $chain
            ->expects($this->once())
            ->method('proceed')
            ->with($request)
            ->willReturn($response);

        /**
         * @var SerializerInterface $serializer
         * @var RequestInterface $request
         * @var MiddlewareChainInterface $chain
         */
        $middleware = new ProblemMiddleware($serializer);

        $this->assertSame($response, $middleware->process($request, $chain));
    }
}
