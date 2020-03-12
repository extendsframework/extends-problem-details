<?php
declare(strict_types=1);

namespace ExtendsFramework\ProblemDetails\Framework\ServiceLocator\Loader;

use ExtendsFramework\ProblemDetails\Framework\Http\Middleware\ProblemMiddleware;
use ExtendsFramework\ProblemDetails\Serializer\Json\JsonSerializer;
use ExtendsFramework\ProblemDetails\Serializer\SerializerInterface;
use ExtendsFramework\ServiceLocator\Resolver\Invokable\InvokableResolver;
use ExtendsFramework\ServiceLocator\Resolver\Reflection\ReflectionResolver;
use ExtendsFramework\ServiceLocator\ServiceLocatorInterface;
use PHPUnit\Framework\TestCase;

class ProblemConfigLoaderTest extends TestCase
{
    /**
     * Load.
     *
     * Test that loader will return correct config.
     *
     * @covers \ExtendsFramework\ProblemDetails\Framework\ServiceLocator\Loader\ProblemConfigLoader::load()
     */
    public function testProcess(): void
    {
        $loader = new ProblemConfigLoader();
        $this->assertSame(
            [
                ServiceLocatorInterface::class => [
                    ReflectionResolver::class => [
                        ProblemMiddleware::class => ProblemMiddleware::class,
                    ],
                    InvokableResolver::class => [
                        SerializerInterface::class => JsonSerializer::class,
                    ],
                ],
            ],
            $loader->load()
        );
    }
}
