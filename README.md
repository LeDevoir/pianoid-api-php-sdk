The unofficial PHP SDK for PianoID API

## Documentation
https://docs.piano.io/piano-id-api

### Install the library

```shell
composer require ledevoir/pianoid-api-php-sdk
```

### Configuration requirements
Configure the following environment variables (must be set in $_ENV[] variable)
or configure values manually in the Environment object

```shell
PIANO_ID_API_BASE_URL='www.whatever.com'
PIANO_APPLICATION_ID='valid_application_id'
PIANO_API_TOKEN='VERY_SECURE_TOKEN'
```

### Usage example
```php
use \LeDevoir\PianoIdApiSDK\Client\GuzzleClient;
use \LeDevoir\PianoIdApiSDK\Request\Login\LoginRequest;

$client = new GuzzleClient();
$request = new LoginRequest('email@email.com', 'password');

$httpResponse = $client->send($request);
$pianoResponse = $request->toPianoIdResponse($httpResponse);

$failed = $pianoResponse->isFailure();
```

### Tests
To debug unit tests
```shell
 XDEBUG_TRIGGER=yes vendor/bin/phpunit tests
```

### Future outlook / TODO
* Might consider guzzle interfaces and main classes (request, response & client integration further ?)
* Base response success transform only works for 1 dimension response object
