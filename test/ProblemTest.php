<?php
declare(strict_types=1);

namespace ExtendsFramework\ProblemDetails;

use PHPUnit\Framework\TestCase;

class ProblemTest extends TestCase
{
    /**
     * Getters.
     *
     * Test that getters will return correct values.
     *
     * @covers \ExtendsFramework\ProblemDetails\Problem::__construct()
     * @covers \ExtendsFramework\ProblemDetails\Problem::getType()
     * @covers \ExtendsFramework\ProblemDetails\Problem::getTitle()
     * @covers \ExtendsFramework\ProblemDetails\Problem::getDetail()
     * @covers \ExtendsFramework\ProblemDetails\Problem::getStatus()
     * @covers \ExtendsFramework\ProblemDetails\Problem::getInstance()
     * @covers \ExtendsFramework\ProblemDetails\Problem::getAdditional()
     */
    public function testGetters(): void
    {
        $problem = new Problem(
            '/foo/type',
            'Problem title',
            'Problem detail',
            400,
            '/foo/instance',
            [
                'foo' => 'bar',
            ]
        );

        $this->assertSame('/foo/type', $problem->getType());
        $this->assertSame('Problem title', $problem->getTitle());
        $this->assertSame('Problem detail', $problem->getDetail());
        $this->assertSame(400, $problem->getStatus());
        $this->assertSame('/foo/instance', $problem->getInstance());
        $this->assertSame(['foo' => 'bar'], $problem->getAdditional());
    }
}
