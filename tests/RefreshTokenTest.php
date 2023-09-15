<?php

namespace LeDevoir\PianoIdApiSDK\Tests;

use LeDevoir\PianoIdApiSDK\Request\Login\RefreshTokenRequest;
use LeDevoir\PianoIdApiSDK\Response\Login\LoginResponse;
use PHPUnit\Framework\TestCase;

class RefreshTokenTest extends TestCase
{
    use InteractsWithMockClient;

    public function testRequest()
    {
        $request = new RefreshTokenRequest('bogus_token');

        $this->assertEquals($request->queryParameters(), ['refresh_token' => 'bogus_token']);
    }

    public function testSuccess()
    {
        $client = $this->getTestClient(
            200,
            '/stubs/refresh/success.stub.json'
        );

        $request = new RefreshTokenRequest('bogus_token');
        $httpResponse = $client->send($request);
        $pianoIdResponse = $request->toPianoIdResponse($httpResponse);

        self::assertInstanceOf(LoginResponse::class, $pianoIdResponse);
        self::assertEquals(
            "eyJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwczovL2lkLnBpYW5vLmlvIiwic3ViIjoiUE5JVG5EcGc5cXF3YWtzIiwiYXVkIjoiRExHRmpYOHRMcSIsImxvZ2luX3RpbWVzdGFtcCI6IjE2MTcyOTk1ODE3OTUiLCJnaXZlbl9uYW1lIjoiaiIsImZhbWlseV9uYW1lIjoiYiIsImVtYWlsIjoianVsaWEuYjMzQHBpYW5vLmlvIiwiZW1haWxfY29uZmlybWF0aW9uX3JlcXVpcmVkIjpmYWxzZSwiZXhwIjoxNjE5OTI3NTgxLCJpYXQiOjE2MTcyOTk1ODEsImp0aSI6IlRJU0xMUkZINW5xcXdjY2QifQ.0YMc64i58TL6wlNF5txuq5RNrpLwfvYkZEMUI18FNsc",
            $pianoIdResponse->getAccessToken()
        );
        self::assertEquals(
            'RF8P6Ic0qqwccd',
            $pianoIdResponse->getRefreshToken()
        );
    }
}