<?php

declare(strict_types=1);

namespace Bench\Builder;

use Illuminate\Container\Container;

final class LaravelBuilder extends Builder
{
    /**
     * @param callable(Container):void $build
     */
    public static function build(string $context, callable $build): Container
    {
        $container = new Container();
        $build($container);

        return $container;
    }
}
