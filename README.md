The unofficial PHP SDK for PianoID API

### Disclaimer
1. This is a work-in-progress in the very early stages
2. Outdated dependencies are used
(i.e. php 7.1, guzzle < 7, etc.)

### Install the library

```shell
composer require ledevoir/pianoid-api-php-sdk
```

### Configuration requirements
Configure the following environment variables (must be set in $_ENV[] variable)

```shell
PIANO_ID_API_BASE_URL='www.whatever.com'
PIANO_APPLICATION_ID='valid_application_id'
PIANO_API_TOKEN='VERY_SECURE_TOKEN'
```

### Tests
To debug unit tests
```shell
 XDEBUG_TRIGGER=yes vendor/bin/phpunit tests
```