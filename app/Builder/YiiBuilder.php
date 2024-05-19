<?php

declare(strict_types=1);

namespace Bench\Builder;

use Yiisoft\Definitions\Exception\InvalidConfigException;
use Yiisoft\Di\Container;
use Yiisoft\Di\ContainerConfig;

final class YiiBuilder extends Builder
{
    /**
     * @param callable():array $build
     * @throws InvalidConfigException
     */
    public static function build(string $context, callable $build): Container
    {
        $config = ContainerConfig::create()
            ->withDefinitions($build());

        return new Container($config);
    }
}
