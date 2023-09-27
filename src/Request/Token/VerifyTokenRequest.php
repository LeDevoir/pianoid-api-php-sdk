<?php

namespace LeDevoir\PianoIdApiSDK\Request\Token;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\Methods\HTTPMethod;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\Token\VerifyTokenResponse;

final class VerifyTokenRequest extends PianoIdRequest
{
    public const PATH = '/token/verify';

    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function method(): HTTPMethod
    {
        return HTTPMethod::POST;
    }

    public function queryParameters(): array
    {
        return [
            'token' => $this->token
        ];
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @inheritDoc
     */
    public function toPianoIdResponse(Response $response): VerifyTokenResponse
    {
        return VerifyTokenResponse::fromResponse($response);
    }

    /**
     * @inheritDoc
     */
    public function path(): string
    {
        return self::PATH;
    }
}