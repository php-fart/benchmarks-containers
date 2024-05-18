# Containers benchmarks

This benchmark shows the performance of the PHP dependency injection containers.

```bash
composer bench
```

## Results


### NonSharedServiceCreationByNameBench

Create service on every call.

```php
$app->get(Service::class); // Service#1
$app->get(Service::class); // Service#2
```

```bash
NonSharedServiceCreationByNameBench
+----------------------+------+-----+----------+---------+---------+
| subject              | revs | its | mem_peak | mode    | rstdev  |
+----------------------+------+-----+----------+---------+---------+
| benchSymfonyRuntime  | 1000 | 20  | 2.331mb  | 1.401μs | ±21.02% |
| benchSymfonyCompiled | 1000 | 20  | 2.331mb  | 0.121μs | ±15.62% |
| benchYii             | 1000 | 20  | 2.330mb  | 0.652μs | ±14.86% |
| benchLaravel         | 1000 | 20  | 2.330mb  | 0.897μs | ±14.04% |
| benchSpiral          | 1000 | 20  | 2.330mb  | 2.216μs | ±6.21%  |
| benchPhpDi           | 1000 | 20  | 2.330mb  | 0.714μs | ±15.66% |
| benchLaminas         | 1000 | 20  | 2.330mb  | 0.424μs | ±26.24% |
+----------------------+------+-----+----------+---------+---------+
```

- Best: **Symfony** (0.121μs)
- Worst: **Spiral** (2.216μs)

### SharedServiceCreationByNameBench

Simple singleton service creation.

```php
$app->get(Service::class); // Service#1
$app->get(Service::class); // Service#1
```

```bash
SharedServiceCreationByNameBench
+----------------------+------+-----+----------+---------+---------+
| subject              | revs | its | mem_peak | mode    | rstdev  |
+----------------------+------+-----+----------+---------+---------+
| benchSymfonyRuntime  | 1000 | 20  | 2.330mb  | 0.138μs | ±26.40% |
| benchSymfonyCompiled | 1000 | 20  | 2.330mb  | 0.041μs | ±16.09% |
| benchYii             | 1000 | 20  | 2.330mb  | 0.048μs | ±11.47% |
| benchLaravel         | 1000 | 20  | 2.330mb  | 0.206μs | ±14.76% |
| benchSpiral          | 1000 | 20  | 2.330mb  | 0.774μs | ±25.12% |
| benchPhpDi           | 1000 | 20  | 2.330mb  | 0.046μs | ±24.64% |
| benchLaminas         | 1000 | 20  | 2.330mb  | 0.042μs | ±21.90% |
+----------------------+------+-----+----------+---------+---------+
```

- Best: **Symfony** (0.041μs)
- Worst: **Spiral** (0.774μs)

### ServiceWithAutowireBench

Service singleton creation with autowiring.

```php
$app->get(Service::class); // Service#1 { dependency: InnerService }
$app->get(Service::class); // Service#1 { dependency: InnerService }
```

```bash
ServiceWithAutowireBench
+----------------------+------+-----+----------+---------+---------+
| subject              | revs | its | mem_peak | mode    | rstdev  |
+----------------------+------+-----+----------+---------+---------+
| benchSymfonyRuntime  | 1000 | 20  | 2.336mb  | 0.134μs | ±7.46%  |
| benchSymfonyCompiled | 1000 | 20  | 2.336mb  | 0.041μs | ±8.78%  |
| benchYii             | 1000 | 20  | 2.336mb  | 0.048μs | ±22.22% |
| benchLaravel         | 1000 | 20  | 2.336mb  | 0.202μs | ±5.34%  |
| benchSpiral          | 1000 | 20  | 2.336mb  | 0.464μs | ±24.02% |
| benchPhpDi           | 1000 | 20  | 2.336mb  | 0.045μs | ±16.34% |
| benchLaminas         | 1000 | 20  | 2.336mb  | 0.042μs | ±2.49%  |
+----------------------+------+-----+----------+---------+---------+
```

- Best: **Symfony** (0.041μs)
- Worst: **Spiral** (0.464μs)

### ServiceCreationFromFactoryBench

Create service on every call from singleton factory service.

```php
$app->get(Service::class); // Service#1 (from Factory#1->create())
$app->get(Service::class); // Service#2 (from Factory#1->create())
```

```bash
ServiceCreationFromFactoryBench
+----------------------+------+-----+----------+----------+---------+
| subject              | revs | its | mem_peak | mode     | rstdev  |
+----------------------+------+-----+----------+----------+---------+
| benchSymfonyRuntime  | 1000 | 20  | 2.338mb  | 1.605μs  | ±12.40% |
| benchSymfonyCompiled | 1000 | 20  | 2.338mb  | 0.146μs  | ±24.72% |
| benchYii             | 1000 | 20  | 2.338mb  | 0.048μs  | ±36.87% |
| benchLaravel         | 1000 | 20  | 2.338mb  | 0.968μs  | ±21.22% |
| benchSpiral          | 1000 | 20  | 2.338mb  | 3.865μs  | ±3.77%  |
| benchPhpDi           | 1000 | 20  | 2.338mb  | 0.044μs  | ±16.73% |
| benchLaminas         | 1000 | 20  | -------  | -------- | ------  |
+----------------------+------+-----+----------+----------+---------+
```

- Best: **PHP-DI** (0.044μs)
- Worst: **Spiral** (3.865μs)
- Note: **Laminas** does not support this functionality (or no?)
