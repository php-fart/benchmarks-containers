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
use Yiisoft\Di\Container as YiiContainer;

use function DI\create as php_di_create;

#[Revs(1000), Warmup(2), Iterations(20)]
#[BeforeMethods('prepare')]
final class SharedServiceCreationByNameBench implements BenchInterface
{
    private SymfonyContainerBuilder $symfonyRuntime;
    private ContainerInterface $symfonyCompiled;
    private YiiContainer $yii;
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
                        ->setPublic(true)
                ]);
            },
        );

        $this->symfonyCompiled = SymfonyCompiledBuilder::build(
            context: __METHOD__,
            build: function (SymfonyContainerBuilder $app) {
                $app->addDefinitions([
                    SimpleService::class => (new Definition(SimpleService::class))
                        ->setPublic(true)
                ]);
            },
        );

        $this->yii = YiiBuilder::build(
            context: __METHOD__,
            build: function (): array {
                return [SimpleService::class => SimpleService::class];
            }
        );

        $this->laravel = LaravelBuilder::build(
            context: __METHOD__,
            build: function (LaravelContainer $app): void {
                $app->singleton(SimpleService::class);
            }
        );

        $this->spiral = SpiralBuilder::build(
            context: __METHOD__,
            build: function (SpiralContainer $app): void {
                $app->bindSingleton(SimpleService::class, SimpleService::class);
            }
        );

        $this->phpdi = PhpDiBuilder::build(
            context: __METHOD__,
            build: function (): array {
                return [
                    SimpleService::class => php_di_create(SimpleService::class)
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
    }

    public function benchSymfonyCompiled(): void
    {
        $instance = $this->symfonyCompiled->get(SimpleService::class);

        assert($instance instanceof SimpleService);
    }

    public function benchYii(): void
    {
        $instance = $this->yii->get(SimpleService::class);

        assert($instance instanceof SimpleService);
    }

    public function benchLaravel(): void
    {
        $instance = $this->laravel->get(SimpleService::class);

        assert($instance instanceof SimpleService);
    }

    public function benchSpiral(): void
    {
        $instance = $this->spiral->get(SimpleService::class);

        assert($instance instanceof SimpleService);
    }

    public function benchPhpDi(): void
    {
        $instance = $this->phpdi->get(SimpleService::class);

        assert($instance instanceof SimpleService);
    }

    public function benchLaminas(): void
    {
        $instance = $this->laminas->get(SimpleService::class);

        assert($instance instanceof SimpleService);
    }
}
