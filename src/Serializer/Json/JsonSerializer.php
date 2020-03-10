<?php
declare(strict_types=1);

namespace ExtendsFramework\Problem\Serializer\Json;

use ExtendsFramework\Problem\ProblemInterface;
use ExtendsFramework\Problem\Serializer\SerializerInterface;

class JsonSerializer implements SerializerInterface
{
    /**
     * @inheritDoc
     */
    public function serialize(ProblemInterface $problem): string
    {
        return json_encode(
            array_filter(
                array_merge(
                    [
                        'type' => $problem->getType(),
                        'title' => $problem->getTitle(),
                        'detail' => $problem->getDetail(),
                        'status' => $problem->getStatus(),
                        'instance' => $problem->getInstance(),
                    ],
                    $problem->getAdditional() ?: []
                )
            )
        );
    }
}
