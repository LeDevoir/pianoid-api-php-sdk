<?php

namespace LeDevoir\PianoIdApiSDK\Request\Login;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\Methods\HTTPMethod;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\Login\LoginResponse;
use LeDevoir\PianoIdApiSDK\Response\PianoIdResponse;

final class RefreshTokenRequest extends PianoIdRequest
{
    private string $refreshToken;

    public function __construct(string $refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    /**
     * @inheritDoc
     */
    public function path(): string
    {
        return '/token/refresh';
    }

    /**
     * @inheritDoc
     */
    public function toPianoIdResponse(Response $response): PianoIdResponse
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
            'refresh_token' => $this->refreshToken
        ];
    }
}