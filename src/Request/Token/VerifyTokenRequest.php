<?php

namespace LeDevoir\PianoIdApiSDK\Request\Token;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\FailureResponse;
use LeDevoir\PianoIdApiSDK\Response\Token\VerifyTokenResponse;

final class VerifyTokenRequest extends PianoIdRequest
{
    private string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function uri(): string
    {
        return sprintf('%s/token/verify', self::BASE_URL);
    }

    public function method(): string
    {
        return self::HTTP_METHOD_POST;
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
    public function success(Response $response): VerifyTokenResponse
    {
        return new VerifyTokenResponse($response);
    }

    /**
     * @inheritDoc
     */
    public function failure(Response $response): FailureResponse
    {
        return new FailureResponse($response);
    }
}