# Containers benchmarks

This benchmark shows the performance of the PHP dependency injection containers.

- [Symfony Dependency Injection Container](https://packagist.org/packages/symfony/dependency-injection)
- [PHP-DI](https://packagist.org/packages/php-di/php-di)
- [Laravel Container](https://packagist.org/packages/illuminate/container)
- [Spiral Container](https://packagist.org/packages/spiral/core)
- [Yii3 Container](https://packagist.org/packages/yiisoft/di)
- [League Container](https://packagist.org/packages/league/container)
- [Laminas Container](https://packagist.org/packages/laminas/laminas-di)

```bash
php app.php containers:bench --iterations=10000
```

## Results
```bash
Benching container performance with getting by name.
 ------- ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------
  #       PHP DI                   Yii                      Spiral                   Laravel                  League                   Laminas                  Symfony
 ------- ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------
  min     0.006 ms - 0 bytes       0.0063 ms - 0 bytes      0.0085 ms - 0 bytes      0.0162 ms - 0 bytes      0.0226 ms - 0 bytes      0.0062 ms - 0 bytes      0.0111 ms - 0 bytes
  max     3.9425 ms - 0 bytes      1.4256 ms - 0 bytes      0.1591 ms - 0 bytes      0.1421 ms - 0 bytes      1.6615 ms - 2.00 MB      0.2457 ms - 0 bytes      0.2025 ms - 0 bytes
  avg     0.0077234 ms - 0 bytes   0.0076936 ms - 0 bytes   0.0122158 ms - 0 bytes   0.0203376 ms - 0 bytes   0.0303355 ms - 0 bytes   0.0100444 ms - 0 bytes   0.0145603 ms - 0 bytes
  total   988.3077 ms              960.6244 ms              1052.6636 ms             1121.8188 ms             1230.8812 ms             1063.3366 ms             1116.9395 ms
 ------- ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------
  Order   - 2 -                    - 1 -                    - 4 -                    - 6 -                    - 7 -                    - 3 -                    - 5 -
 ------- ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------

Benching container performance with autowiring.
 ------- ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------
  #       PHP DI                   Yii                      Spiral                   Laravel                  League                   Laminas
 ------- ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------
  min     0.0487 ms - 0 bytes      0.0706 ms - 0 bytes      0.3245 ms - 0 bytes      0.1753 ms - 0 bytes      0.1964 ms - 0 bytes      0.0771 ms - 0 bytes
  max     3.1853 ms - 0 bytes      2.6646 ms - 0 bytes      1.1043 ms - 0 bytes      0.7654 ms - 0 bytes      1.8375 ms - 0 bytes      3.0486 ms - 0 bytes
  avg     0.0605565 ms - 0 bytes   0.0856609 ms - 0 bytes   0.3797469 ms - 0 bytes   0.2017357 ms - 0 bytes   0.2228839 ms - 0 bytes   0.0928257 ms - 0 bytes
  total   1610.3265 ms             1879.6877 ms             4797.3544 ms             3112.3417 ms             3312.7847 ms             1992.7877 ms
 ------- ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------
  Order   - 1 -                    - 2 -                    - 6 -                    - 4 -                    - 5 -                    - 3 -
 ------- ------------------------ ------------------------ ------------------------ ------------------------ ------------------------ ------------------------
```
