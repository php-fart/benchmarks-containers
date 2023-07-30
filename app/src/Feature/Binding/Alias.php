<?php

declare(strict_types=1);

namespace App\Feature\Binding;

final class Alias extends BaseBinding
{
    public static function new(
        string $class,
    ): self {
        return new self($class);
    }
}
