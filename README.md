The unofficial PHP SDK for PianoID API

## Documentation
https://docs.piano.io/piano-id-api

### Disclaimer
1. This is a work-in-progress in the very early stages
2. Outdated dependencies are used because of other project constraints, but upgrading the project to the latest php project and dependencies would be easily feasible
(i.e. php 7.1, guzzle < 7, etc.)

### Install the library

```shell
composer require ledevoir/pianoid-api-php-sdk
```

### Configuration requirements
Configure the following environment variables (must be set in $_ENV[] variable)
or configure values manually in the environment object

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

### Future outlook / TODO

* Might consider guzzle interfaces and main classes (request, response & client integration further ?)
* Base response success transform only works for 1 dimension response object
