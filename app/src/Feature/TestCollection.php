<?php

declare(strict_types=1);

namespace App\Feature;

use App\Feature\Attribute\CaseMethod;
use App\Feature\Attribute\Description;
use App\Feature\Case\BaseCase;
use App\Feature\Result\CaseMethodResult;
use App\Feature\Result\CaseResult;
use App\Feature\State\ContainerState;

final class TestCollection
{
    /** @var array<string, class-string<ContainerState>> */
    private array $containers = [];

    /** @var array<\ReflectionClass<BaseCase>> */
    private array $cases = [];

    /**
     * @param class-string<ContainerState> $containerState
     */
    public function addContainer(string $name, string $containerState): void
    {
        $this->containers[$name] = $containerState;
    }

    /**
     * @param class-string<BaseCase> $case
     */
    public function addCase(string $case): void
    {
        $reflection = new \ReflectionClass($case);
        $name = $reflection->getShortName();

        $this->cases[$name] = $reflection;
    }

    /**
     * @return array<CaseResult>
     */
    public function run(): array
    {
        $result = [];
        foreach ($this->cases as $caseName => $case) {
            $caseResult = new CaseResult(
                caseName: $caseName,
                description:
                    ($case->getAttributes(Description::class)[0] ?? null)?->newInstance()->value ?? '',
            );

            foreach ($case->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
                if ($method->getAttributes(CaseMethod::class) === []) {
                    continue;
                }
                $instance = $case->newInstance();

                foreach ($this->containers as $containerName => $class) {
                    $c = $this->begin($containerName);
                    $message = null;
                    try {
                        $status = $method->invoke($instance, $c);
                        if (!$status instanceof Status) {
                            if (\is_string($status)) {
                                $message = $status;
                                $status = Status::Special;
                            } else {
                                $status = Status::Supported;
                            }
                        }
                    } catch (\Throwable) {
                        $status = Status::Failed;
                    }

                    $methodResult = new CaseMethodResult(
                        $containerName,
                        $status,
                        $message,
                    );
                    $caseResult->addMethodResult($methodResult);
                }
            }
            $result[] = $caseResult;
        }
        return $result;
    }

    private function begin(string $name): ContainerState
    {
        $class = $this->containers[$name];
        return $class::create();
    }
}
