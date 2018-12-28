# PHP Hyper.host API Client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/m1guelpf/hyperhost-api.svg?style=flat-square)](https://packagist.org/packages/m1guelpf/fly-api)
[![Software License](https://img.shields.io/github/license/m1guelpf/php-hyperhost-api.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/m1guelpf/php-hyperhost-api/master.svg?style=flat-square)](https://travis-ci.org/m1guelpf/php-hyperhost-api)
[![Total Downloads](https://img.shields.io/packagist/dt/m1guelpf/hyperhost-api.svg?style=flat-square)](https://packagist.org/packages/m1guelpf/hyperhost-api)

This package makes it easy to interact with [the Hyper.host API](https://documenter.getpostman.com/view/4184902/Rzn9tgpz#410d0f97-7051-418d-82eb-9031e6cac808).

## Requirements

This package requires PHP >= 5.5.

## Installation

You can install the package via composer:

``` bash
composer require m1guelpf/hyperhost-api
```

## Usage

You must pass a Guzzle client and the API token to the constructor of `M1guelpf\HyperHostAPI\HyperHost`.

``` php
$hyperhost = new \M1guelpf\HyperHostAPI\HyperHost('YOUR_API_TOKEN');
```

or you can skip the token and use the `connect()` method later

``` php
$hyperhost = new \M1guelpf\HyperHostAPI\HyperHost();

$hyperhost->connect('YOUR_FLY_API_TOKEN');
```

### Get all Teams

``` php
$hyperhost->getTeams();
```

### Get a specific Team

``` php
$hyperhost->getTeam($teamId);
```

### Create a Team

``` php
$hyperhost->createTeam($name, $slug);
```

### Invite someone to a Team

``` php
$hyperhost->inviteTeamMember($teamId, $email);
```

### Get all Packages

``` php
$hyperhost->getPackages();
```

### Get SSO Link

``` php
$hyperhost->getSSOLink($packageId);
```

### Create a Package

``` php
$hyperhost->createPackage($domain, $platform, $teamId);
```

### Start a Migration

``` php
$hyperhost->startMigration($host, $user, $password, $domain);
```

### Get the Guzzle Client

``` php
$hyperhost->getClient();
```

### Set the Guzzle Client

``` php
$client = new \GuzzleHttp\Client(); // Example Guzzle client
$hyperhost->setClient($client);
```
where $client is an instance of `\GuzzleHttp\Client`.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email soy@miguelpiedrafita.com instead of using the issue tracker.

## Credits

- [Miguel Piedrafita](https://github.com/m1guelpf)
- [All Contributors](../../contributors)

## License

The MIT License. Please see [License File](LICENSE.md) for more information.
