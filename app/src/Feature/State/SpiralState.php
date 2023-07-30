<?php

declare(strict_types=1);

namespace App\Feature\State;

use App\Feature\Binding;
use App\Feature\Container\Spiral;
use App\Feature\ContainerInterface;
use Spiral\Core\Config\Alias;use Spiral\Core\Container;

final class SpiralState extends ContainerState
{
    private Container $container;

    public function __construct()
    {
        $this->container = new Container();
    }

    public function build(): ContainerInterface
    {
        return new Spiral($this->container);
    }

    public function destroy(): void
    {
        $this->container->__destruct();
        unset($this->container);
    }

    public function singleton(string $id, Binding\BaseBinding $binding): void
    {
        $this->container->bindSingleton($id, $this->convertBinding($binding, true));
    }

    private function convertBinding(Binding\BaseBinding $binding, bool $singleton): mixed
    {
        return match(true) {
            $binding instanceof Binding\Alias => new Alias($binding->getValue(), $singleton),
            default => $binding->getValue(),
        };
    }
}
