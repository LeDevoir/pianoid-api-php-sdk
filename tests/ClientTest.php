<?php

use LeDevoir\PianoIdApiSDK\Client\Client;

class ClientTest extends PHPUnit\Framework\TestCase
{
    public function testValidConfiguration()
    {
        $client = Client::getInstance(
            'www.not-whatever.com',
            'another-valid_application_id',
            'Another_secure_token'
        );

        self::assertNotNull($client);
    }

    public function testRequiredBaseUrl()
    {
        self::expectException(\RuntimeException::class);
        self::expectExceptionMessage('Base url is required to create client instance.');

        Client::getInstance(
            '',
            $_ENV['PIANO_APPLICATION_ID'],
            $_ENV['PIANO_API_TOKEN']
        );
    }

    public function testRequiredApplicationId()
    {
        self::expectException(\RuntimeException::class);
        self::expectExceptionMessage('Application id is required to create client instance.');

        Client::getInstance(
            $_ENV['PIANO_ID_API_BASE_URL'],
            '',
            $_ENV['PIANO_API_TOKEN']
        );
    }

    public function testRequiredApiToken()
    {
        self::expectException(\RuntimeException::class);
        self::expectExceptionMessage('Api token is required to create client instance.');

        Client::getInstance(
            $_ENV['PIANO_ID_API_BASE_URL'],
            $_ENV['PIANO_APPLICATION_ID'],
            ''
        );
    }
}