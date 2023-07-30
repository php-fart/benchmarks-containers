<?php

declare(strict_types=1);

namespace App\Feature\Case;

use App\Feature\Exception\WrongBehavior;

abstract class BaseCase
{
    public function getName(): string
    {
        // return short class name
        return (new \ReflectionClass($this))->getShortName();
    }

    protected function checkBehavior(bool $param, string $message): void
    {
        if (!$param) {
            throw new WrongBehavior("Failed on behavior check: $message");
        }
    }
}
