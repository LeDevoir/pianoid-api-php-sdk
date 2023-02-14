<?php

namespace LeDevoir\PianoIdApiSDK\Request\Login;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\Login\LoginResponse;

class GenerateTokenRequest extends PianoIdRequest
{
    public const PATH = '/token';
    public const UID_KEY = 'uid';

    private string $pianoUid;

    public function __construct(string $uid)
    {
        $this->pianoUid = $uid;
    }

    /**
     * @inheritDoc
     */
    public function toPianoIdResponse(Response $response): LoginResponse
    {
        return new LoginResponse($response);
    }

    /**
     * @inheritDoc
     */
    public function method(): string
    {
        return self::HTTP_METHOD_POST;
    }

    /**
     * @inheritDoc
     */
    public function queryParameters(): array
    {
        return [
            self::UID_KEY => $this->pianoUid
        ];
    }

    /**
     * @inheritDoc
     */
    protected function path(): string
    {
        return self::PATH;
    }
}