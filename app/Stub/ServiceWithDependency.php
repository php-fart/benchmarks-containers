<?php

declare(strict_types=1);

namespace Bench\Stub;

final readonly class ServiceWithDependency
{
    public function __construct(
        public SimpleService $dependency,
    ) {}
}
