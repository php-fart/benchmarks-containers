<?php

declare(strict_types=1);

namespace Bench\Builder;

use Laminas\Di\DefaultContainer;
use Laminas\Di\Injector;

final class LaminasRuntimeBuilder extends Builder
{
    /**
     * @param callable(Injector):void $build
     */
    public static function build(string $context, callable $build): DefaultContainer
    {
        $injector = new Injector();

        $container = new class($injector) extends DefaultContainer {
            public $injector;
        };

        $build($injector);

        return $container;
    }
}
