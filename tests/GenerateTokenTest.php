<?php

namespace LeDevoir\PianoIdApiSDK\Tests;

use LeDevoir\PianoIdApiSDK\Request\Login\GenerateTokenRequest;
use LeDevoir\PianoIdApiSDK\Request\Methods\HTTPMethod;
use LeDevoir\PianoIdApiSDK\Response\Login\LoginResponse;
use PHPUnit\Framework\TestCase;

class GenerateTokenTest extends TestCase
{
    use InteractsWithMockClient;

    private const URL = '/id/api/v1/publisher/token';

    public function testRequest()
    {
        $request = new GenerateTokenRequest(
            'valid-uuid'
        );

        $this->assertEquals(HTTPMethod::POST, $request->method());
        $this->assertEquals(self::URL, $request->url());
        $this->assertEquals(
            [
                'uid' => 'valid-uuid'
            ],
            $request->queryParameters()
        );

        $client = $this->getTestClient(
            200,
            '/stubs/login/success.stub.json'
        );

        $httpResponse = $client->send($request);
        $pianoIdResponse = $request->toPianoIdResponse($httpResponse);

        self::assertInstanceOf(LoginResponse::class, $pianoIdResponse);
        self::assertEquals(
            "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c",
            $pianoIdResponse->getAccessToken()
        );
        self::assertEquals(
            'RFGQfHHGrpddt2',
            $pianoIdResponse->getRefreshToken()
        );
    }
}