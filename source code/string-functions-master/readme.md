# String Functions

[![Build Status](http://img.shields.io/travis/typedphp/string-functions.svg?style=flat-square)](https://travis-ci.org/typedphp/string-functions)
[![Code Quality](http://img.shields.io/scrutinizer/g/typedphp/string-functions.svg?style=flat-square)](https://scrutinizer-ci.com/g/typedphp/string-functions)
[![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/typedphp/string-functions.svg?style=flat-square)](http://typedphp.github.io/string-functions/master)
[![Version](http://img.shields.io/packagist/v/typedphp/string-functions.svg?style=flat-square)](https://packagist.org/packages/typedphp/string-functions)
[![License](http://img.shields.io/packagist/l/typedphp/string-functions.svg?style=flat-square)](licence.md)

## Example

```php
use TypedPHP\Functions\StringFunctions;

StringFunctions\endsWith("a long string", "string"); // true
StringFunctions\replace("a long string", "long", "enormous"); // "a enormous string"
```

Functions:

- `startsWith(string $haystack, string $needle) → bool`
- `endsWith(string $haystack, string $needle) → bool`
- `indexOf(string $haystack, string $needle, int $offset = 0) → int`
- `length(string $string) → int`
- `matches(string $haystack, string $needle) → bool`
- `replace(string $haystack, string|array $needle, string|array $replacement) → string`
- `slice(string $string, int $offset = 0, int $limit = 0) → string`
- `split(string $haystack, string|null $needle = null, int $limit = 0) → array`
- `trim(string $haystack, string $needle) → string`
- `trimLeft(string $haystack, string $needle) → string`
- `trimRight(string $haystack, string $needle) → string`

Caveats:

- Every `$needle` can be a normal string or a regular expression string.

## Installation

```sh
❯ composer require "typedphp/string-functions:*"
```

## Testing

```sh
❯ composer create-project "typedphp/string-functions:*" .
❯ vendor/bin/phpunit
```
