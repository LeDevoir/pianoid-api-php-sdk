<?php

namespace LeDevoir\PianoIdApiSDK\Request\Logout;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\Methods\HTTPMethod;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\Logout\LogoutResponse;

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
        return LogoutResponse::fromResponse($response);
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
            self::TOKEN_KEY => $this->token
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