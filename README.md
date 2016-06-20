# freeagent-php
[![Build Status](https://travis-ci.org/6by6/freeagent-php.svg?branch=master)](https://travis-ci.org/6by6/freeagent-php)

This is a PHP library that provides a comprehensive wrapper for the [Freeagent v2 API](https://dev.freeagent.com/).

## Installation
You can install this library via [Composer](https://getcomposer.org/download/):

`composer require 6by6/freeagent-php`

## Compatibility 
We are currently testing against the following PHP versions:
* '5.6'
* '7.0'
* hhvm
* nightly

## Unit Tests
Phpunit tests are provided with the library, however, we would **strongly** 
recommend **NOT** executing these against your live account. The tests 
require a clean account and part of the process involves deleting any 
data before starting i.e. everything about your business.

The test suite will attempt to ensure you are not using a live account before
executing tests, however, we will not be held responsible for any loss of 
data.

If you're just getting started we would recommend using a sandbox 
account (obtainable via the [Freeagent API Quickstart Guide](https://dev.freeagent.com/docs/quick_start)).

## Getting Started

### Get a list of invoices
```
use SixBySix\Freeagent\OAuth\Api;
use SixBySix\Freeagent\Entity\EntityCollection;
use SixBySix\Freeagent\Entity\Invoice;

/** @var Api $api */
$api = new Api(
  $clientId = getenv('API_CLIENT_ID'),
  $clientSecret = getenv('API_CLIENT_SECRET'),
  $refreshToken = getenv('API_REFRESH_TOKEN'),
  $sandbox = true
);

/** @var EntityCollection $invoiceCollection */
$invoiceCollection = $api->invoice()->query([
  'view' => 'last_3_months',
]);

/** @var Invoice $invoice */
foreach ($invoiceCollection as $invoice) {
  echo "{$invoice->getReference()}\n";
}
```

## Bug Reports
Please use the [Github Issue Tracker](https://github.com/6by6/freeagent-php/issues) for support.

