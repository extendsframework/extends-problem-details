<?php
declare(strict_types=1);

namespace ExtendsFramework\Problem\Serializer;

use ExtendsFramework\Problem\ProblemInterface;

interface SerializerInterface
{
    /**
     * Serialize problem.
     *
     * @param ProblemInterface $problem
     *
     * @return string
     */
    public function serialize(ProblemInterface $problem): string;
}
