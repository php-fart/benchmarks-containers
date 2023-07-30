<?php

declare(strict_types=1);

namespace App\Feature\Container;

use App\Feature\ContainerInterface;
use Spiral\Core\Container;

final class Spiral implements ContainerInterface
{
    public function __construct(
        private Container $container,
    ) {
    }

    public function make(string $id): mixed
    {
        return $this->container->make($id);
    }

    public function get(string $id)
    {
        return $this->container->get($id);
    }

    public function has(string $id): bool
    {
        return $this->container->has($id);
    }
}
