<?php

use LeDevoir\PianoIdApiSDK\Request\BaseRequest;
use LeDevoir\PianoIdApiSDK\Request\LoginRequest;
use PHPUnit\Framework\TestCase;

class LoginTest extends TestCase
{
    const LOGIN_URL = '/id/api/v1/publisher/login';

    public function testExpectations()
    {
        $request = new LoginRequest(
            'email@email.com',
            'secret'
        );

        self::assertEquals(
            self::LOGIN_URL,
            $request->uri()
        );

        self::assertEquals(
            BaseRequest::HTTP_METHOD_POST,
            $request->method()
        );

        self::assertArrayHasKey(
            LoginRequest::EMAIL_KEY,
            $request->queryParameters()
        );

        self::assertArrayHasKey(
            LoginRequest::PASSWORD_KEY,
            $request->queryParameters()
        );

        self::assertEquals('email@email.com', $request->queryParameters()[LoginRequest::EMAIL_KEY]);
        self::assertEquals('secret', $request->queryParameters()[LoginRequest::PASSWORD_KEY]);
    }
}