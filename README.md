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
php app.php bench:containers --iterations=10000
```

## Results
```bash
Benching container performance with getting by name.
 ------- -------------------------- ---------------------------------- -------------------------- -------------------------- -------------------------- --------------------------
  #       Spiral                     Yii                                Laravel                    League                     Symfony                    PHP DI
 ------- -------------------------- ---------------------------------- -------------------------- -------------------------- -------------------------- --------------------------
  min     0.002976 ms - 0 bytes      0.000651 ms - 0 bytes              0.001793 ms - 0 bytes      0.002365 ms - 0 bytes      0.001292 ms - 0 bytes      0.000561 ms - 0 bytes
  max     0.061946 ms - 0 bytes      0.657383 ms - 0 bytes              0.100278 ms - 0 bytes      0.721804 ms - 2.00 MB      0.038412 ms - 0 bytes      1.614008 ms - 0 bytes
  avg     0.003289454 ms - 0 bytes   0.00074492599999999 ms - 0 bytes   0.001965198 ms - 0 bytes   0.002720537 ms - 0 bytes   0.001394952 ms - 0 bytes   0.000651637 ms - 0 bytes
  total   211.385251 ms - 4.00 MB    179.869189 ms - 4.00 MB            193.79833 ms - 4.00 MB     202.094357 ms - 4.00 MB    201.046873 ms - 4.00 MB    182.343351 ms - 4.00 MB
 ------- -------------------------- ---------------------------------- -------------------------- -------------------------- -------------------------- --------------------------
  Order   - 6 -                      - 2 -                              - 4 -                      - 5 -                      - 3 -                      - 1 -
 ------- -------------------------- ---------------------------------- -------------------------- -------------------------- -------------------------- --------------------------

Benching container performance with autowiring.
 ------- -------------------------- -------------------------- -------------------------- -------------------------- --------------------------
  #       Spiral                     Yii                        Laravel                    League                     PHP DI
 ------- -------------------------- -------------------------- -------------------------- -------------------------- --------------------------
  min     0.035256 ms - 0 bytes      0.007735 ms - 0 bytes      0.018985 ms - 0 bytes      0.02118 ms - 0 bytes       0.00534 ms - 0 bytes
  max     0.221496 ms - 0 bytes      1.138135 ms - 0 bytes      0.363272 ms - 0 bytes      0.62881 ms - 0 bytes       1.027497 ms - 0 bytes
  avg     0.037867412 ms - 0 bytes   0.008283834 ms - 0 bytes   0.020277138 ms - 0 bytes   0.022836258 ms - 0 bytes   0.005759382 ms - 0 bytes
  total   571.741785 ms - 0 bytes    261.904161 ms - 0 bytes    385.299841 ms - 0 bytes    424.260258 ms - 0 bytes    237.05475 ms - 0 bytes
 ------- -------------------------- -------------------------- -------------------------- -------------------------- --------------------------
  Order   - 5 -                      - 2 -                      - 3 -                      - 4 -                      - 1 -
 ------- -------------------------- -------------------------- -------------------------- -------------------------- --------------------------
```
