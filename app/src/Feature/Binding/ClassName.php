<?php

declare(strict_types=1);

namespace App\Feature\Binding;

final class ClassName extends BaseBinding
{
    /**
     * @param class-string $class
     */
    public static function new(
        string $class,
    ): self {
        return new self($class);
    }
}
