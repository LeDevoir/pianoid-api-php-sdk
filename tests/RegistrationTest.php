<?php

namespace LeDevoir\PianoIdApiSDK\Tests;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\Registration\PasswordlessRegistrationRequest;
use LeDevoir\PianoIdApiSDK\Response\Registration\PasswordlessRegistrationResponse;
use PHPUnit\Framework\TestCase;

class RegistrationTest extends TestCase
{
    use InteractsWithMockClient;

    private const FULL_PATH = '/id/api/v1/publisher/register';

    public function testRegistrationMethods()
    {
        $request = new PasswordlessRegistrationRequest(
            'example@ledevoir.com',
            'First',
            'Last'
        );

        $this->assertEquals(
            self::FULL_PATH,
            $request->url()
        );

        $this->assertInstanceOf(
            PasswordlessRegistrationResponse::class,
            $request->toPianoIdResponse(new Response())
        );
    }

    public function testRegistrationBadRequest()
    {
        $request = new PasswordlessRegistrationRequest(
            'example@ledevoir.com',
            'First',
            'Last'
        );

        $client = $this->getTestClient(
            400,
            '/stubs/registration/badRequest.stub.json'
        );

        $response = $client->send($request);
        $this->assertEquals(400, $response->getStatusCode());

        $transformed = $request->toPianoIdResponse($response);
        $this->assertTrue($transformed->isFailure());
        $this->assertEquals(
            [
                'Email format is not valid'
            ],
            $transformed->errors()
        );

        /**
         * Test bad request default values
         */
        $this->assertEquals('', $transformed->getAccessToken());
        $this->assertEquals('', $transformed->getTokenType());
        $this->assertEquals('', $transformed->getRefreshToken());
        $this->assertEquals(0, $transformed->getExpiresIn());
        $this->assertFalse($transformed->extendExpiredAccessEnabled);
        $this->assertFalse($transformed->registration);
        $this->assertFalse($transformed->emailConfirmationRequired);
    }

    public function testRegistrationSuccess()
    {
        $request = new PasswordlessRegistrationRequest(
            'example@ledevoir.com',
            'First',
            'Last'
        );

        $client = $this->getTestClient(
            200,
            '/stubs/registration/success.stub.json'
        );

        $response = $client->send($request);
        $this->assertEquals(200, $response->getStatusCode());

        $transformed = $request->toPianoIdResponse($response);
        $this->assertEquals(
            'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c',
            $transformed->getAccessToken()
        );
    }
}