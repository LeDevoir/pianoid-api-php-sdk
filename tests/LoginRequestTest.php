<?php

namespace LeDevoir\PianoIdApiSDK\Tests;

use GuzzleHttp\Exception\ServerException;
use LeDevoir\PianoIdApiSDK\Client\GuzzleClient;
use LeDevoir\PianoIdApiSDK\Environment;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Request\Login\LoginRequest;
use PHPUnit\Framework\TestCase;

/**
 * @property GuzzleClient $client
 */
class LoginRequestTest extends TestCase
{
    use InteractsWithMockClient;

    const LOGIN_URL = '/id/api/v1/publisher/login';

    public function testRequestAttributes()
    {
        $request = new LoginRequest(
            'email@email.com',
            'secret'
        );

        self::assertEquals(self::LOGIN_URL, $request->uri());
        self::assertEquals(PianoIdRequest::HTTP_METHOD_POST, $request->method());

        self::assertArrayHasKey(LoginRequest::EMAIL_KEY, $request->queryParameters());
        self::assertArrayHasKey(LoginRequest::PASSWORD_KEY, $request->queryParameters());

        self::assertEquals('email@email.com', $request->queryParameters()[LoginRequest::EMAIL_KEY]);
        self::assertEquals('secret', $request->queryParameters()[LoginRequest::PASSWORD_KEY]);
    }

    public function testSuccess()
    {
        $client = new GuzzleClient(
            new Environment(),
            $this->mockClientWithStubbedResponse(
                200,
                '/stubs/login/success'
            )
        );

        $request = new LoginRequest(
            'email@email.com',
            'secret'
        );

        $response = $client->send($request);

        self::assertEquals(200, $response->getResponse()->getStatusCode());
        self::assertEquals(false, $response->isError());
        self::assertEquals('Bearer', $response->getTokenType());
        self::assertEquals('RFGQfHHGrpddt2', $response->getRefreshToken());
        self::assertEquals(3599, $response->getExpiresIn());
        self::assertEquals(
            "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c",
            $response->getAccessToken()
        );
    }

    public function testForbiddenRequest()
    {
        $client = new GuzzleClient(
            new Environment(),
            $this->mockClientWithStubbedResponse(
                403,
                '/stubs/login/forbidden'
            )
        );

        $request = new LoginRequest(
            'email@email.com',
            'secret'
        );

        $response = $client->send($request);

        self::assertEquals(403, $response->getResponse()->getStatusCode());
        self::assertEquals(true, $response->isError());
        self::assertEquals(
            'That combination of email and password is not recognized',
            $response->errorMessage()
        );
    }

    public function testBadRequest()
    {
        $client = new GuzzleClient(
            new Environment(),
            $this->mockClientWithStubbedResponse(
                400,
                '/stubs/login/badRequest'
            )
        );

        $request = new LoginRequest(
            '',
            'secret'
        );

        $response = $client->send($request);

        self::assertEquals(400, $response->getResponse()->getStatusCode());
        self::assertEquals(true, $response->isError());
        self::assertEquals(
            'Required params are missing: email',
            $response->errorMessage()
        );
    }

    public function testServerError()
    {
        self::expectException(ServerException::class);
        self::expectExceptionCode(500);
        $client = new GuzzleClient(
            new Environment(),
            $this->mockClientWithStubbedResponse(
                500,
                '/stubs/login/serverError'
            )
        );

        $request = new LoginRequest(
            'email@email.com',
            'secret'
        );

        $client->send($request);
    }
}


