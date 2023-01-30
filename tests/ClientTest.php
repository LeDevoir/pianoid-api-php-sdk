<?php

use LeDevoir\PianoIdApiSDK\Client\Client;

class ClientTest extends PHPUnit\Framework\TestCase
{
    public function testEnvironmentVariables()
    {
        $client = Client::getInstance();

        self::assertNotNull($client);
    }
}