# Very short description of the package

[![Latest Version on Packagist](https://img.shields.io/packagist/v/wedevbr/idwall-laravel.svg?style=flat-square)](https://packagist.org/packages/wedevbr/idwall-laravel)
[![Total Downloads](https://img.shields.io/packagist/dt/wedevbr/idwall-laravel.svg?style=flat-square)](https://packagist.org/packages/wedevbr/idwall-laravel)
![GitHub Actions](https://github.com/wedevbr/idwall-laravel/actions/workflows/main.yml/badge.svg)

This is an unofficial wrapper for [ID Wall API](https://idwall.co).

## Requirements
PHP >= 8.1
Laravel >= 9.x

## Installation

You can install the package via composer:

```bash
composer require wedevbr/idwall-laravel
```

After install, you can publish your config files:

```bash
php artisan vendor:publish --provider="WeDevBr\IdWall\IdWallServiceProvider"
```
## Usage
First you need to set up your credentials. Define yours `IDWALL_AUTH_TOKEN` and `IDWALL_API_URL`

Then, finally use:
```php
$idWallReport = \IdWall::clientReport();
$reports = $idWallReport->getAllReports();
// Do your logic
```

### Testing

```bash
vendor/bin/pest
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email adeildo.amorim@wedev.software instead of using the issue tracker.

## Credits

-   [Adeildo Amorim](https://github.com/wedevbr)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com).
