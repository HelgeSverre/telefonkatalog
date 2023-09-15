# Laravel Telefonkatalog: Query Public Norwegian Phone Numbers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/helgesverre/laravel-telefonkatalog.svg?style=flat-square)](https://packagist.org/packages/helgesverre/laravel-telefonkatalog)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/helgesverre/laravel-telefonkatalog/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/helgesverre/laravel-telefonkatalog/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/helgesverre/laravel-telefonkatalog/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/helgesverre/laravel-telefonkatalog/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/helgesverre/laravel-telefonkatalog.svg?style=flat-square)](https://packagist.org/packages/helgesverre/laravel-telefonkatalog)

Laravel Telefonkatalog offers a unified interface to query Norwegian phone numbers and retrieve associated personal
details like owner's name, address, and more from public phone directories. This package caters primarily to Norwegian
developers, designed to enhance customer experience by autofilling form details through phone number lookup – a feature
becoming increasingly common in today's digital realm.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
    - [Search](#search)
    - [Find](#find)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Legal Threats](#legal-threats)
- [Security Vulnerabilities](#security-vulnerabilities)
- [Credits](#credits)
- [License](#license)

## Installation

Install the package through Composer:

```bash
composer require helgesverre/laravel-telefonkatalog
```

## Usage

To use the Telefonkatalog, initialize and make your calls:

```php
$telefonkatalog = new HelgeSverre\Telefonkatalog();

// Search for a Norwegian phone number to retrieve details
$results = $telefonkatalog->search('12345678');

// Find the first match for a Norwegian phone number
$person = $telefonkatalog->find('12345678');
```

### Search

Query across all data sources using a Norwegian phone number:

```php
$results = $telefonkatalog->search('12345678');
```

### Find

Retrieve the first matching result:

```php
$person = $telefonkatalog->find('12345678');
```

## Testing

Run the tests with:

```bash
composer test
```

## Legal Threats

Please direct your cease-and-desist letters to postkasse@datatilsynet.no

## License

Laravel Telefonkatalog is open-source, licensed under The MIT License (MIT). For more details, see
the [License File](LICENSE.md).
