<?php

declare(strict_types=1);

namespace Bench\Builder;

use DI\Container;
use DI\ContainerBuilder;

final class PhpDiBuilder extends Builder
{
    /**
     * @param callable():array $build
     * @throws \Exception
     */
    public static function build(string $context, callable $build): Container
    {
        $builder = new ContainerBuilder();
        $builder->useAutowiring(true);
        $builder->addDefinitions($build());

        return $builder->build();
    }
}
