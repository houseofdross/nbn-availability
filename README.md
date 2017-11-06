NBN Availability Checker
========================

[![Latest Version](https://img.shields.io/github/release/houseofdross/nbn-availability.svg?style=flat-square)](https://github.com/houseofdross/nbn-availability/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/houseofdross/nbn-availability/master.svg?style=flat-square)](https://travis-ci.org/houseofdross/nbn-availability)
[![Maintainability](https://api.codeclimate.com/v1/badges/efa445488a81d46e7d33/maintainability)](https://codeclimate.com/github/houseofdross/nbn-availability/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/efa445488a81d46e7d33/test_coverage)](https://codeclimate.com/github/houseofdross/nbn-availability/test_coverage)

nbn-availability is a simple library to help check the availability
of the National Broadband Network at a given location in Australia

The goal of the library is to provide a very simple interface to check
whether the network is available, and if it is, what technology is being
implemented at that location

System Requirements
-------------------

You need **PHP >= 7.1.0** to use this library due to scalar type hinting

Install
-------

Install `nbn-availability` using Composer.

``` bash
$ composer require hod/nbn-availability
```

Testing
-------

`nbn-avilability` has a [PHPUnit](https://phpunit.de) test suite and a coding 
style compliance test suite using [PHP CS Fixer](http://cs.sensiolabs.org/). 
To run the tests, run the following command from the project folder.

``` bash
$ composer test
```

Usage
-----

``` php
<?php
use Hod\NbnAvailability\AvailabilityChecker;

$checker = new AvailabilityChecker();
$availabilityStatus = $availabilityChecker->checkAvailability(-37.8568731, 144.8961339);
var_dump(json_encode($availabilityStatus));

```

License
-------

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.
