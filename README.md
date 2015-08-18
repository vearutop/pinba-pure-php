# pinba-pure-php

[![Build Status](https://travis-ci.org/vearutop/pinba-pure-php.svg?branch=master)](https://travis-ci.org/vearutop/pinba-pure-php)

Pinba extension in pure PHP

HHVM and PHP7 ready drop-in replacement

Installation
------------

Add package to your application with ``composer require vearutop/pinba-pure-php``.

Since you can not ``ini_set('pinba.enabled', 1)`` without extension you need to control it with ``pinba`` class.
```php
if (class_exists('pinba', false)) {
    pinba::ini_set_auto_flush(false);
    pinba::ini_set_enabled(1);
    pinba::ini_set_server('127.0.0.1:3300');
}
```