# Array Functions

[![Build Status](http://img.shields.io/travis/typedphp/array-functions.svg?style=flat-square)](https://travis-ci.org/typedphp/array-functions)
[![Code Quality](http://img.shields.io/scrutinizer/g/typedphp/array-functions.svg?style=flat-square)](https://scrutinizer-ci.com/g/typedphp/array-functions)
[![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/typedphp/array-functions.svg?style=flat-square)](http://typedphp.github.io/array-functions/master)
[![Version](http://img.shields.io/packagist/v/typedphp/array-functions.svg?style=flat-square)](https://packagist.org/packages/typedphp/array-functions)
[![License](http://img.shields.io/packagist/l/typedphp/array-functions.svg?style=flat-square)](licence.md)

## Example

```php
use TypedPHP\Functions\ArrayFunctions;

ArrayFunctions\map([1, 2, 3], function($item) { return $item * 2; }); // [2, 4, 6]
ArrayFunctions\contains(["foo", "bar", "baz"], "bar"); // true
```

Functions:

- `contains(array $haystack, $needle) → bool`
- `each(array $array, callable $callback) → array`
- `exclude(array $array, array $exclude) → array`
- `filter(array $array, callable $callback) → array`
- `length(array $array) → int`
- `has(array $array, $needle) → bool`
- `join(array $array, $glue) → string`
- `map(array $array, callable $callback) →  array`
- `merge(array $array, array $merge) → array`
- `slice(array $array, $offset = 0, $limit = 0) → array`
- `random(array $array) → mixed`

Caveats:

- Nope

## Installation

```sh
❯ composer require "typedphp/array-functions:*"
```

## Testing

```sh
❯ composer create-project "typedphp/array-functions:*" .
❯ vendor/bin/phpunit
```
