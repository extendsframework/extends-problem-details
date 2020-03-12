<?php
declare(strict_types=1);

namespace ExtendsFramework\ProblemDetails\Serializer;

use ExtendsFramework\ProblemDetails\ProblemInterface;

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
