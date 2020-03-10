<?php
declare(strict_types=1);

namespace ExtendsFramework\Problem\Serializer\Json;

use ExtendsFramework\Problem\ProblemInterface;
use PHPUnit\Framework\TestCase;

class JsonSerializerTest extends TestCase
{
    /**
     * Serialize.
     *
     * Test that serialize will return correct JSON string.
     *
     * @covers \ExtendsFramework\Problem\Serializer\Json\JsonSerializer::serialize()
     */
    public function testSerialize(): void
    {
        $problem = $this->createMock(ProblemInterface::class);
        $problem
            ->expects($this->once())
            ->method('getType')
            ->willReturn('/foo/type');

        $problem
            ->expects($this->once())
            ->method('getTitle')
            ->willReturn('Problem title');

        $problem
            ->expects($this->once())
            ->method('getDetail')
            ->willReturn('Problem detail');

        $problem
            ->expects($this->once())
            ->method('getStatus')
            ->willReturn(400);

        $problem
            ->expects($this->once())
            ->method('getInstance')
            ->willReturn('/foo/instance');

        $problem
            ->expects($this->once())
            ->method('getAdditional')
            ->willReturn([
                'foo' => 'bar',
            ]);

        /**
         * @var ProblemInterface $problem
         */
        $serializer = new JsonSerializer();

        $this->assertSame(
            json_encode([
                'type' => '/foo/type',
                'title' => 'Problem title',
                'detail' => 'Problem detail',
                'status' => 400,
                'instance' => '/foo/instance',
                'foo' => 'bar',
            ]),
            $serializer->serialize($problem)
        );
    }
}
