<?php

declare(strict_types=1);

namespace Bench\Builder;

use Spiral\Core\Container;

final class SpiralBuilder extends Builder
{
    /**
     * @param callable():void $build
     */
    public static function build(string $context, callable $build): Container
    {
        $container = new Container();
        $build($container);

        return $container;
    }
}
