<?php

declare(strict_types=1);

namespace App\Endpoint\Console;

use App\Feature\Case\Singleton;
use App\Feature\State\SpiralState;
use App\Feature\TestCollection;
use Spiral\Console\Attribute\AsCommand;
use Spiral\Console\Command;

#[AsCommand(
    name: 'containers:features',
    description: 'Bench containers features',
)]
final class ContainerFeatureCommand extends Command
{
    private readonly TestCollection $testCollection;

    public function __construct(string $name = null)
    {
        parent::__construct($name);

        $this->testCollection = new TestCollection();
        $this->testCollection->addContainer('Spiral', SpiralState::class);
        $this->testCollection->addCase(Singleton::class);
    }

    public function __invoke()
    {
        $result = $this->testCollection->run();

        foreach ($result as $caseResult) {
            $this->info('# ' . $caseResult->caseName);
            if (!empty($caseResult->description)) {
                $this->writeln("\033[90m" . $caseResult->description . "\033[0m");
            }

            foreach ($caseResult->methodResults as $methodResult) {
                $this->writeln(sprintf('  <info>%s</info>: %s', $methodResult->container, $methodResult->status->name));
                if (!empty($methodResult->message)) {
                    $this->info(sprintf("    \033[90m%s\033[0m", $methodResult->message));
                }
            }
        }
    }
}
