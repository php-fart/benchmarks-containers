<?php

declare(strict_types=1);

namespace App\Feature\Binding;

abstract class BaseBinding
{
    protected function __construct(
        protected mixed $value,
    ) {
    }

    public function getValue(): mixed
    {
        return $this->value;
    }
}
