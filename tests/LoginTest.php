<?php

namespace LeDevoir\PianoIdApiSDK\Tests;

use GuzzleHttp\Exception\ServerException;
use LeDevoir\PianoIdApiSDK\Client\GuzzleClient;
use LeDevoir\PianoIdApiSDK\Request\Login\LoginRequest;
use LeDevoir\PianoIdApiSDK\Request\Methods\HTTPMethod;
use PHPUnit\Framework\TestCase;

/**
 * @property GuzzleClient $client
 */
class LoginTest extends TestCase
{
    use InteractsWithMockClient;

    const LOGIN_URL = '/id/api/v1/publisher/login';

    public function testRequestAttributes()
    {
        $request = new LoginRequest(
            'email@email.com',
            'secret'
        );

        self::assertEquals(self::LOGIN_URL, $request->url());
        self::assertEquals(HTTPMethod::POST, $request->method());

        self::assertArrayHasKey(LoginRequest::EMAIL_KEY, $request->queryParameters());
        self::assertArrayHasKey(LoginRequest::PASSWORD_KEY, $request->queryParameters());

        self::assertEquals('email@email.com', $request->queryParameters()[LoginRequest::EMAIL_KEY]);
        self::assertEquals('secret', $request->queryParameters()[LoginRequest::PASSWORD_KEY]);
    }

    public function testSuccess()
    {
        $client = $this->getTestClient(
            200,
            '/stubs/login/success.stub.json'
        );

        $request = new LoginRequest(
            'email@email.com',
            'secret'
        );

        $response = $client->send($request);
        $transformed = $request->toPianoIdResponse($response);

        self::assertEquals(200, $response->getStatusCode());
        self::assertEquals(false, $transformed->isFailure());
        self::assertEquals('Bearer', $transformed->getTokenType());
        self::assertEquals('RFGQfHHGrpddt2', $transformed->getRefreshToken());
        self::assertEquals(3599, $transformed->getExpiresIn());
        self::assertEquals(
            "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c",
            $transformed->getAccessToken()
        );
    }

    public function testForbiddenRequest()
    {
        $client = $this->getTestClient(
            403,
            '/stubs/login/forbidden.stub.json'
        );

        $request = new LoginRequest(
            'email@email.com',
            'secret'
        );

        $response = $client->send($request);
        $transformed = $request->toPianoIdResponse($response);

        self::assertEquals(403, $response->getStatusCode());
        self::assertEquals(true, $transformed->isFailure());
        self::assertEquals(
            'That combination of email and password is not recognized',
            $transformed->errorMessage()
        );
        self::assertEquals('', $transformed->getAccessToken());
    }

    public function testBadRequest()
    {
        $client = $this->getTestClient(
            400,
            '/stubs/login/badRequest.stub.json'
        );

        $request = new LoginRequest(
            '',
            'secret'
        );

        $response = $client->send($request);
        $transformed = $request->toPianoIdResponse($response);

        self::assertEquals(400, $response->getStatusCode());
        self::assertEquals(true, $transformed->isFailure());
        self::assertEquals(
            'Required params are missing: email',
            $transformed->errorMessage()
        );
    }

    public function testServerError()
    {
        self::expectException(ServerException::class);
        self::expectExceptionCode(500);
        $client = $this->getTestClient(
            500,
            '/stubs/login/serverError.stub.json'
        );

        $request = new LoginRequest(
            'email@email.com',
            'secret'
        );

        $client->send($request);
    }
}


