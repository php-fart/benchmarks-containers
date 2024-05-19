<?php

declare(strict_types=1);

namespace Bench\Builder;

use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;
use Symfony\Component\DependencyInjection\Dumper\PhpDumper;

final class SymfonyCompiledBuilder extends Builder
{
    /**
     * @param callable(SymfonyContainerBuilder):void $build
     */
    public static function build(string $context, callable $build): ContainerInterface
    {
        $builder = new SymfonyContainerBuilder();
        $build($builder);
        $builder->compile();

        $name = self::compile($context, $builder);

        return new $name();
    }

    private static function compile(string $context, SymfonyContainerBuilder $builder): string
    {
        $dumper = new PhpDumper($builder);

        $name = '__CompiledBenchContainer' . \hash('xxh128', $context);
        $pathname = self::getStorageDirectory() . '/' . $name . '.php';

        $result = $dumper->dump(['class' => $name]);
        \file_put_contents($pathname, $result);

        require $pathname;

        return $name;
    }
}
