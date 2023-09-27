<?php

namespace LeDevoir\PianoIdApiSDK\Tests\stubs;

use LeDevoir\PianoIdApiSDK\Request\Logout\LogoutRequest;
use LeDevoir\PianoIdApiSDK\Response\Logout\LogoutResponse;
use LeDevoir\PianoIdApiSDK\Tests\InteractsWithMockClient;
use PHPUnit\Framework\TestCase;

class LogoutRequestTest extends TestCase
{
    use InteractsWithMockClient;

    private const URL = '/id/api/v1/publisher/logout';

    public function testRequest()
    {
        $request = new LogoutRequest(
            'valid_token'
        );

        self::assertEquals(self::URL, $request->url());
        self::assertEquals(['token' => 'valid_token'], $request->queryParameters());

        $client = $this->getTestClient(200, '/stubs/logout/success.stub.json');
        $httpResponse = $client->send($request);
        self::assertInstanceOf(LogoutResponse::class, $request->toPianoIdResponse($httpResponse));
    }
}