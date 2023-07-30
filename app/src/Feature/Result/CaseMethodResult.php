<?php

declare(strict_types=1);

namespace App\Feature\Result;

use App\Feature\Status;

final class CaseMethodResult
{
    public function __construct(
        public readonly string $container,
        public readonly Status $status,
        public readonly ?string $message = null,
    ) {
    }
}
