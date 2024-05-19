<?php

declare(strict_types=1);

namespace Bench\Stub;

final class ServiceFactory
{
    public function create(): SimpleService
    {
        return new SimpleService();
    }
}
