# Number Functions

[![Build Status](http://img.shields.io/travis/typedphp/number-functions.svg?style=flat-square)](https://travis-ci.org/typedphp/number-functions)
[![Code Quality](http://img.shields.io/scrutinizer/g/typedphp/number-functions.svg?style=flat-square)](https://scrutinizer-ci.com/g/typedphp/number-functions)
[![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/typedphp/number-functions.svg?style=flat-square)](http://typedphp.github.io/number-functions/master)
[![Version](http://img.shields.io/packagist/v/typedphp/number-functions.svg?style=flat-square)](https://packagist.org/packages/typedphp/number-functions)
[![License](http://img.shields.io/packagist/l/typedphp/number-functions.svg?style=flat-square)](licence.md)

## Example

```php
use TypedPHP\Functions\NumberFunctions;

NumberFunctions\absolute(-0.5); // 0.5
NumberFunctions\power(2, 2); // 4.0
NumberFunctions\ceiling(1.4); // 2
NumberFunctions\random(5, 10); // 7
NumberFunctions\limit(15, 5, 10); // 10
```

Functions:

- `absolute(int|float $number) → float`
- `arcCosine(int|float $number) → float`
- `arcSine(int|float $number) → float`
- `arcTangent(int|float $number) → float`
- `cosine(int|float $number) → float`
- `exponent(int|float $number) → float`
- `hyperbolicCosine(int|float $number) → float`
- `hyperbolicSine(int|float $number) → float`
- `hyperbolicTangent(int|float $number) → float`
- `arcHyperbolicCosine(int|float $number) → float`
- `arcHyperbolicSine(int|float $number) → float`
- `arcHyperbolicTangent(int|float $number) → float`
- `logarithm(int|float $number) → float`
- `sine(int|float $number) → float`
- `squareRoot(int|float $number) → float`
- `tangent(int|float $number) → float`
- `degrees(int|float $number) → float`
- `radians(int|float $number) → float`
- `modulus(int|float $number, int|float $divisor) → float`
- `power(int|float $number, int|float $power) → float`
- `round(int|float $number) → int`
- `ceiling(int|float $number) → int`
- `floor(int|float $number) → int`
- `random(int|float $min, int|float $max) → int|float`
- `limit(int|float $number, int|float $min, int|float $max) → int|float`

Caveats:

- These functions accept either `int` or `float`.

## Installation

```sh
❯ composer require "typedphp/number-functions:*"
```

## Testing

```sh
❯ composer create-project "typedphp/number-functions:*" .
❯ vendor/bin/phpunit
```
