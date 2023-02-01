<?php

namespace LeDevoir\PianoIdApiSDK\Tests;

use LeDevoir\PianoIdApiSDK\Request\Token\VerifyTokenRequest;
use PHPUnit\Framework\TestCase;

class VerifyTokenTest extends TestCase
{
    use InteractsWithMockClient;

    private const VERIFY_TOKEN_URL = '/id/api/v1/publisher/token/verify';

    public function testRequestAttributes()
    {
        $request = new VerifyTokenRequest(
            'very_secure_token'
        );

        self::assertEquals('POST', $request->method());
        self::assertEquals(self::VERIFY_TOKEN_URL, $request->uri());
        self::assertEquals('very_secure_token', $request->getToken());
        self::assertEmpty(array_diff(['token' => 'very_secure_token'], $request->queryParameters()));
    }
}