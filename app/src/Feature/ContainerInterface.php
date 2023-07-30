<?php

declare(strict_types=1);

namespace App\Feature;

interface ContainerInterface extends \Psr\Container\ContainerInterface
{
    public function make(string $id): mixed;
}
