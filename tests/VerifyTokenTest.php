<?php

namespace LeDevoir\PianoIdApiSDK\Tests;

use GuzzleHttp\Exception\GuzzleException;
use LeDevoir\PianoIdApiSDK\Client\GuzzleClient;
use LeDevoir\PianoIdApiSDK\Environment;
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

    /**
     * @covers \LeDevoir\PianoIdApiSDK\Response\Token\VerifyTokenResponse::getAccessToken
     * @covers \LeDevoir\PianoIdApiSDK\Response\Token\VerifyTokenResponse::getExpiresIn
     * @covers \LeDevoir\PianoIdApiSDK\Response\Token\VerifyTokenResponse::getTokenType
     *
     * @return void
     * @throws GuzzleException
     */
    public function testSuccess(): void
    {
        $client = new GuzzleClient(
            new Environment(),
            $this->mockClientWithStubbedResponse(
                200,
                '/stubs/verifyToken/success.stub.json'
            )
        );

        $token = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5';
        $request = new VerifyTokenRequest($token);

        $response = $client->send($request);
        $transformed = $request->toPianoIdResponse($response);

        self::assertTrue($response->getStatusCode() === 200);
        self::assertEquals($token, $transformed->getAccessToken());
        self::assertEquals(1337, $transformed->getExpiresIn());
        self::assertEquals('Bearer', $transformed->getTokenType());
    }

    /**
     * @covers \LeDevoir\PianoIdApiSDK\Response\Token\VerifyTokenResponse::errorMessage
     * @return void
     * @throws GuzzleException
     */
    public function testForbiddenRequest(): void
    {
        $client = new GuzzleClient(
            new Environment(),
            $this->mockClientWithStubbedResponse(
                403,
                '/stubs/verifyToken/forbidden.stub.json'
            )
        );

        $request = new VerifyTokenRequest(
            'invalid_token'
        );

        $response = $client->send($request);
        $transformed = $request->toPianoIdResponse($response);

        self::assertEquals(403, $response->getStatusCode());
        self::assertEquals(
            'Invalid access token',
            $transformed->errorMessage()
        );
    }
}