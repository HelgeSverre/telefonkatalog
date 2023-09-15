# Query public Norwegian phone numbers to retrieve structured personal data.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/helgesverre/laravel-telefonkatalog.svg?style=flat-square)](https://packagist.org/packages/helgesverre/laravel-telefonkatalog)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/helgesverre/laravel-telefonkatalog/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/helgesverre/laravel-telefonkatalog/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/helgesverre/laravel-telefonkatalog/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/helgesverre/laravel-telefonkatalog/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/helgesverre/laravel-telefonkatalog.svg?style=flat-square)](https://packagist.org/packages/helgesverre/laravel-telefonkatalog)

A laravel package for querying Norwegian phone numbers and retrieving the owners name, address and other details from
from public phone directories, this is only relevant for Norwegian developers, and the use case for this is to autofill
customer details in a form by looking them up by their phone number, which is a relatively common feature.

## Installation

You can install the package via composer:

```bash
composer require helgesverre/laravel-telefonkatalog
```

## Usage

```php
$telefonkatalog = new HelgeSverre\Telefonkatalog();
echo $telefonkatalog->echoPhrase('Hello, HelgeSverre!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Legal Threats

Kindly send your cease-and-desists letters to spam@helgesverre.com.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Helge Sverre](https://github.com/HelgeSverre)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
