
This is skeleton for functional test suite.

TODO:
 * Optimization (do we really need separate sessions for each test?)
 * Fallback (close session if test fails)
 * Automatic screenshot capturing feature (like PHPUnit's Selenium 1)
 * Repeated test for multiple browsers

Installation
============

```bash
wget http://getcomposer.org/installer -O - | php
./composer.phar update --dev
```


Testing
=======

```bash
vendor/bin/phpunit
```
