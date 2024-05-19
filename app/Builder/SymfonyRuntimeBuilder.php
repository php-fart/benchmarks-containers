<?php

declare(strict_types=1);

namespace Bench\Builder;

use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;

final class SymfonyRuntimeBuilder extends Builder
{
    /**
     * @param callable(SymfonyContainerBuilder):void $build
     */
    public static function build(string $context, callable $build): SymfonyContainerBuilder
    {
        $builder = new SymfonyContainerBuilder();
        $build($builder);
        $builder->compile();

        return $builder;
    }
}
