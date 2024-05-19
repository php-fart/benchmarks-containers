<?php

declare(strict_types=1);

namespace Bench\Builder;

use Psr\Container\ContainerInterface;

abstract class Builder
{
    protected static function getStorageDirectory(): string
    {
        return \dirname(__DIR__, 2) . '/storage';
    }

    abstract public static function build(string $context, callable $build): ContainerInterface;
}
