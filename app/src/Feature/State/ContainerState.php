<?php

declare(strict_types=1);

namespace App\Feature\State;

use App\Feature\Binding\BaseBinding;
use App\Feature\ContainerInterface;

abstract class ContainerState
{
    public static function create(): static
    {
        return new static();
    }

    abstract public function build(): ContainerInterface;

    abstract public function destroy(): void;

    abstract public function singleton(string $id, BaseBinding $binding): void;
}
