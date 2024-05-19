<?php

declare(strict_types=1);

namespace Bench;

use Bench\Builder\LaminasRuntimeBuilder;
use Bench\Builder\LaravelBuilder;
use Bench\Builder\PhpDiBuilder;
use Bench\Builder\SpiralBuilder;
use Bench\Builder\SymfonyCompiledBuilder;
use Bench\Builder\SymfonyRuntimeBuilder;
use Bench\Builder\YiiBuilder;
use Bench\Stub\SimpleService;
use DI\Container as PhpDiContainer;
use Illuminate\Container\Container as LaravelContainer;
use Laminas\Di\DefaultContainer as LaminasDefaultContainer;
use Laminas\Di\Injector as LaminasInjector;
use PhpBench\Attributes\BeforeMethods;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;
use PhpBench\Attributes\Warmup;
use Psr\Container\ContainerInterface;
use Spiral\Core\Container as SpiralContainer;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Yiisoft\Factory\Factory;

use function DI\create as php_di_create;

#[Revs(1000), Warmup(2), Iterations(20)]
#[BeforeMethods('prepare')]
final class NonSharedServiceCreationByNameBench implements BenchInterface
{
    private SymfonyContainerBuilder $symfonyRuntime;
    private ContainerInterface $symfonyCompiled;
    private Factory $yii;
    private LaravelContainer $laravel;
    private SpiralContainer $spiral;
    private PhpDiContainer $phpdi;
    private LaminasDefaultContainer $laminas;

    public function prepare(): void
    {
        $this->symfonyRuntime = SymfonyRuntimeBuilder::build(
            context: __METHOD__,
            build: function (SymfonyContainerBuilder $app) {
                $app->addDefinitions([
                    SimpleService::class => (new Definition(SimpleService::class))
                        ->setShared(false)
                        ->setPublic(true)
                ]);
            },
        );

        $this->symfonyCompiled = SymfonyCompiledBuilder::build(
            context: __METHOD__,
            build: function (SymfonyContainerBuilder $app) {
                $app->addDefinitions([
                    SimpleService::class => (new Definition(SimpleService::class))
                        ->setShared(false)
                        ->setPublic(true)
                ]);
            },
        );

        $this->yii = new Factory(YiiBuilder::build(
            context: __METHOD__,
            build: function (): array {
                return [SimpleService::class => SimpleService::class];
            }
        ));

        $this->laravel = LaravelBuilder::build(
            context: __METHOD__,
            build: function (LaravelContainer $app): void {
                $app->bind(SimpleService::class);
            }
        );

        $this->spiral = SpiralBuilder::build(
            context: __METHOD__,
            build: function (SpiralContainer $app): void {
                $app->bind(SimpleService::class, SimpleService::class);
            }
        );

        $this->phpdi = PhpDiBuilder::build(
            context: __METHOD__,
            build: function (): array {
                return [
                    SimpleService::class => php_di_create(SimpleService::class),
                ];
            }
        );

        $this->laminas = LaminasRuntimeBuilder::build(
            context: __METHOD__,
            build: function (LaminasInjector $app): void {
                $app->create(SimpleService::class);
            }
        );
    }

    public function benchSymfonyRuntime(): void
    {
        $instance = $this->symfonyRuntime->get(SimpleService::class);

        assert($instance instanceof SimpleService);
        assert($instance !== $this->symfonyRuntime->get(SimpleService::class));
    }

    public function benchSymfonyCompiled(): void
    {
        $instance = $this->symfonyCompiled->get(SimpleService::class);

        assert($instance instanceof SimpleService);
        assert($instance !== $this->symfonyCompiled->get(SimpleService::class));
    }

    public function benchYii(): void
    {
        $instance = $this->yii->create(SimpleService::class);

        assert($instance instanceof SimpleService);
        assert($instance !== $this->yii->create(SimpleService::class));
    }

    public function benchLaravel(): void
    {
        $instance = $this->laravel->get(SimpleService::class);

        assert($instance instanceof SimpleService);
        assert($instance !== $this->laravel->get(SimpleService::class));
    }

    public function benchSpiral(): void
    {
        $instance = $this->spiral->get(SimpleService::class);

        assert($instance instanceof SimpleService);
        assert($instance !== $this->spiral->get(SimpleService::class));
    }

    public function benchPhpDi(): void
    {
        $instance = $this->phpdi->make(SimpleService::class);

        assert($instance instanceof SimpleService);
        assert($instance !== $this->phpdi->make(SimpleService::class));
    }

    public function benchLaminas(): void
    {
        $instance = $this->laminas->injector->create(SimpleService::class);

        assert($instance instanceof SimpleService);
        assert($instance !== $this->laminas->injector->create(SimpleService::class));
    }
}
