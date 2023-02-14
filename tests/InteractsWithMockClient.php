<?php

namespace LeDevoir\PianoIdApiSDK\Tests;

use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;

trait InteractsWithMockClient
{
    public function mockClientWithStubbedResponse(int $status, string $stubFilePath): Client
    {
        $mock = new MockHandler([
            new Response(
                $status,
                [],
                file_get_contents(
                    sprintf(
                        '%s%s',
                        __DIR__,
                        $stubFilePath
                    )
                )
            ),
        ]);

        return new Client(['handler' => HandlerStack::create($mock)]);
    }
}


