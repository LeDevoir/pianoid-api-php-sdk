<?php

namespace LeDevoir\PianoIdApiSDK\Request\Login;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\Methods\HTTPMethod;
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
        return LoginResponse::fromResponse($response);
    }

    /**
     * @inheritDoc
     */
    public function method(): HTTPMethod
    {
        return HTTPMethod::POST;
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
    public function path(): string
    {
        return self::PATH;
    }
}