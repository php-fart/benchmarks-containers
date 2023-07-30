<?php

declare(strict_types=1);

namespace App\Feature\Binding;

final class AsIs extends BaseBinding
{
    public static function new(
        mixed $class,
    ): self {
        return new self($class);
    }
}
