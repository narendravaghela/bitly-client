# Bitly PHP Client
[![Build Status](https://travis-ci.org/narendravaghela/bitly-client.svg?branch=master)](https://travis-ci.org/narendravaghela/bitly-client)
[![License](https://poser.pugx.org/narendravaghela/bitly-client/license)](https://packagist.org/packages/narendravaghela/bitly-client)
[![Latest Stable Version](https://poser.pugx.org/narendravaghela/bitly-client/v/stable)](https://packagist.org/packages/narendravaghela/bitly-client)
[![Total Downloads](https://poser.pugx.org/narendravaghela/bitly-client/downloads)](https://packagist.org/packages/narendravaghela/bitly-client)  

PHP client library to access Bitly APIs. Register your account at [Bitly.com](https://bitly.com/) and get your access token from [here](https://bitly.com/a/oauth_apps).

## Requirements
This library has the following requirements:
* PHP 5.6.x or greater.

## Installation

You can install this library into your application using [composer](http://getcomposer.org).

```
composer require narendravaghela/bitly-client
```

## Usage

Once you install this library, load it using the composer autoload option and use the `BitlyClient` class object. See below example,
```php
<?php

require 'vendor/autoload.php';

use Bitly\BitlyClient;

$bitlyClient = new BitlyClient('your-access-token');

$options = ['longUrl' => 'http://www.example.com/a-log-url-slug/'];

$response = $bitlyClient->shorten($options);
```

### Response format
Bitly suppoerts `json`, `xml` and `txt` response types. You can specify the response type in your `$options` array. The default response format is `json`.

```php
<?php

require 'vendor/autoload.php';

use Bitly\BitlyClient;

$bitlyClient = new BitlyClient('your-access-token');

$options = [
    'longUrl' => 'http://www.example.com/a-log-url-slug/',
    'format' => 'xml' // pass json, xml or txt
];

$response = $bitlyClient->shorten($options);
```
We recommend to use `json` and `xml` formats only as `txt` response sometimes does not work.

## Documentation
As of now, this library provides API methods for following modules.
* [Links](docs/Links.md)

## Reporting Issues & Contributing

If you have a problem with this libray or any bug, please open an issue on [GitHub](https://github.com/narendravaghela/bitly-client/issues). Also, if you have solution to any existing bug, create a Pull Request. This library follows PSR-2 standards, so please make sure you follow the same while making changes.



