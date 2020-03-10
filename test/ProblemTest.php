<?php
declare(strict_types=1);

namespace ExtendsFramework\Problem;

use PHPUnit\Framework\TestCase;

class ProblemTest extends TestCase
{
    /**
     * Getters.
     *
     * Test that getters will return correct values.
     *
     * @covers \ExtendsFramework\Problem\Problem::__construct()
     * @covers \ExtendsFramework\Problem\Problem::getType()
     * @covers \ExtendsFramework\Problem\Problem::getTitle()
     * @covers \ExtendsFramework\Problem\Problem::getDetail()
     * @covers \ExtendsFramework\Problem\Problem::getStatus()
     * @covers \ExtendsFramework\Problem\Problem::getInstance()
     * @covers \ExtendsFramework\Problem\Problem::getAdditional()
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
