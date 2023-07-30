<?php

declare(strict_types=1);

namespace App\Feature\Attribute;

#[\Attribute(\Attribute::TARGET_METHOD|\Attribute::TARGET_CLASS)]
final class Description
{
    public function __construct(
        public readonly string $value,
    ) {
    }
}
