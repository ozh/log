# Ozh\Log

A minimalist PSR-3 compliant logger, that logs into an array.

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

## Install

Via Composer

``` bash
$ composer require ozh/log
```

## Usage

``` php
use \Ozh\Log\Logger;

require '../vendor/autoload.php';

$logger = new Logger();
$logger->debug('This is a debug message');
```

See `examples/examples.php` for more examples.


[ico-version]: https://img.shields.io/packagist/v/ozh/log.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/ozh/log/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/ozh/log.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/ozh/log.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ozh/log.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ozh/log
[link-travis]: https://travis-ci.org/ozh/log
[link-scrutinizer]: https://scrutinizer-ci.com/g/ozh/log/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/ozh/log
[link-downloads]: https://packagist.org/packages/ozh/log
[link-author]: https://github.com/ozh
[link-contributors]: ../../contributors
