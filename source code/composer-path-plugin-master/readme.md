# Composer Path Plugin

![Build Status](http://img.shields.io/travis/typedphp/composer-path-plugin.svg?style=flat-square)
![Code Quality](http://img.shields.io/scrutinizer/g/typedphp/composer-path-plugin.svg?style=flat-square)
![Code Coverage](http://img.shields.io/scrutinizer/coverage/g/typedphp/composer-path-plugin.svg?style=flat-square)
![Version](http://img.shields.io/packagist/v/typedphp/composer-path-plugin.svg?style=flat-square)
![License](http://img.shields.io/packagist/l/typedphp/composer-path-plugin.svg?style=flat-square)

A Composer plugin which allows any package to define its own install path.

## Examples

You can define where a dependency should install itself to:

```php
"extra" : {
    "path" : "tests"
}
```

You can override the install paths of other dependencies:

```php
"extra" : {
    "paths" : {
        "symfony/*" : "symfony"
    }
}
```

## Installation

```sh
❯ composer require "typedphp/composer-path-plugin:*"
```

## Testing

```sh
❯ composer create-project "typedphp/composer-path-plugin:*" .
❯ vendor/bin/phpunit
```
