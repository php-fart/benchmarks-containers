<?php

declare(strict_types=1);

namespace App\Feature\Result;

final class CaseResult
{
    /** @var array<string, CaseMethodResult> */
    public array $methodResults = [];

    public function __construct(
        public readonly string $caseName,
        public readonly string $description = '',
    ) {
    }

    public function addMethodResult(CaseMethodResult $methodResult): void
    {
        $this->methodResults[$methodResult->container] = $methodResult;
    }
}
