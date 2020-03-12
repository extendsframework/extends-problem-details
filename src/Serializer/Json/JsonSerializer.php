<?php
declare(strict_types=1);

namespace ExtendsFramework\ProblemDetails\Serializer\Json;

use ExtendsFramework\ProblemDetails\ProblemInterface;
use ExtendsFramework\ProblemDetails\Serializer\SerializerInterface;

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
