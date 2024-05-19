<?php

declare(strict_types=1);

namespace Bench;

use Bench\Builder\LaravelBuilder;
use Bench\Builder\PhpDiBuilder;
use Bench\Builder\SpiralBuilder;
use Bench\Builder\SymfonyCompiledBuilder;
use Bench\Builder\SymfonyRuntimeBuilder;
use Bench\Builder\YiiBuilder;
use Bench\Stub\ServiceFactory;
use Bench\Stub\SimpleService;
use DI\Container as PhpDiContainer;
use Illuminate\Container\Container as LaravelContainer;
use PhpBench\Attributes\BeforeMethods;
use PhpBench\Attributes\Iterations;
use PhpBench\Attributes\Revs;
use PhpBench\Attributes\Warmup;
use Psr\Container\ContainerInterface;
use Spiral\Core\Container as SpiralContainer;
use Symfony\Component\DependencyInjection\ContainerBuilder as SymfonyContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Yiisoft\Di\Container as YiiContainer;

use function DI\create as php_di_create;
use function DI\factory as php_di_factory;

#[Revs(1000), Warmup(2), Iterations(20)]
#[BeforeMethods('prepare')]
final class ServiceCreationFromFactoryBench implements BenchInterface
{
    private SymfonyContainerBuilder $symfonyRuntime;
    private ContainerInterface $symfonyCompiled;
    private YiiContainer $yii;
    private LaravelContainer $laravel;
    private SpiralContainer $spiral;
    private PhpDiContainer $phpdi;

    public function prepare(): void
    {
        $this->symfonyRuntime = SymfonyRuntimeBuilder::build(
            context: __METHOD__,
            build: function (SymfonyContainerBuilder $app) {
                $app->addDefinitions([
                    ServiceFactory::class => new Definition(ServiceFactory::class),
                    SimpleService::class => (new Definition(SimpleService::class))
                        ->setFactory([new Reference(ServiceFactory::class), 'create'])
                        ->setShared(false)
                        ->setPublic(true),
                ]);
            },
        );

        $this->symfonyCompiled = SymfonyCompiledBuilder::build(
            context: __METHOD__,
            build: function (SymfonyContainerBuilder $app) {
                $app->addDefinitions([
                    ServiceFactory::class => new Definition(ServiceFactory::class),
                    SimpleService::class => (new Definition(SimpleService::class))
                        ->setFactory([new Reference(ServiceFactory::class), 'create'])
                        ->setShared(false)
                        ->setPublic(true),
                ]);
            },
        );

        $this->yii = YiiBuilder::build(
            context: __METHOD__,
            build: function (): array {
                return [
                    ServiceFactory::class => ServiceFactory::class,
                    SimpleService::class => static fn (ServiceFactory $factory): SimpleService
                        => $factory->create(),
                ];
            }
        );

        $this->laravel = LaravelBuilder::build(
            context: __METHOD__,
            build: function (LaravelContainer $app): void {
                $app->singleton(ServiceFactory::class);
                $app->bind(SimpleService::class, static function ($app): SimpleService {
                    $factory = $app->make(ServiceFactory::class);
                    return $factory->create();
                });
            }
        );

        $this->spiral = SpiralBuilder::build(
            context: __METHOD__,
            build: function (SpiralContainer $app): void {
                $app->bindSingleton(ServiceFactory::class, ServiceFactory::class);
                $app->bind(SimpleService::class, function (ServiceFactory $ref) {
                    return $ref->create();
                });
            }
        );

        $this->phpdi = PhpDiBuilder::build(
            context: __METHOD__,
            build: function (): array {
                return [
                    ServiceFactory::class => php_di_create(ServiceFactory::class),
                    SimpleService::class => php_di_factory([ServiceFactory::class, 'create']),
                ];
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
        // Idk how to do it, is it supported at all?
        usleep(30);
    }
}
