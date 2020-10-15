# 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/get-things-done/shareholder.svg?style=flat-square)](https://packagist.org/packages/get-things-done/shareholder)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/get-things-done/shareholder/run-tests?label=tests)](https://github.com/get-things-done/shareholder/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/get-things-done/shareholder.svg?style=flat-square)](https://packagist.org/packages/get-things-done/shareholder)


This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.


## Installation

You can install the package via composer:

```bash
composer require get-things-done/shareholder
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --provider="GetThingsDone\Shareholder\ShareholderServiceProvider" --tag="migrations"
php artisan migrate
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="GetThingsDone\Shareholder\ShareholderServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
];
```

## Usage

``` php
$shareholder = new GetThingsDone\Shareholder();
echo $shareholder->echoPhrase('Hello, GetThingsDone!');
```

## Testing

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Cao Minh Duc](https://github.com/cao-minh-duc)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
