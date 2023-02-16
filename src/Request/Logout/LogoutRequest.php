<?php

namespace LeDevoir\PianoIdApiSDK\Request\Logout;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\Logout\LogoutResponse;
use LeDevoir\PianoIdApiSDK\Response\PianoIdResponse;

class LogoutRequest extends PianoIdRequest
{
    public const PATH = '/logout';
    public const TOKEN_KEY = 'token';

    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @inheritDoc
     */
    public function toPianoIdResponse(Response $response): LogoutResponse
    {
        return new LogoutResponse($response);
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
            self::TOKEN_KEY => $this->token
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