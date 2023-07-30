<?php

declare(strict_types=1);

namespace App\Feature\Binding;

final class Closure extends BaseBinding
{
    public static function new(
        \Closure $class,
    ): self {
        return new self($class);
    }
}
