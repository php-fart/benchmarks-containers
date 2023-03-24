<?php

declare(strict_types=1);

namespace App\Containers;

use Laminas\Di\DefaultContainer;
use Laminas\Di\Injector;
use Laminas\Di\InjectorInterface;

final class Laminas implements ContainerInterface
{
    private DefaultContainer $container;
    private InjectorInterface $injector;

    public function __construct()
    {
        $this->injector = new Injector();
        $this->container = new DefaultContainer($this->injector);
    }

    public function make(string $id): mixed
    {
        return $this->injector->create($id);
    }

    public function get(string $id)
    {
        return $this->container->get($id);
    }

    public function has(string $id): bool
    {
        return $this->container->has($id);
    }

    public function bind(string $id, $definition): void
    {
        $this->container->setInstance($id, $definition);
    }

    public function init(): void
    {
        // TODO: Implement init() method.
    }
}
