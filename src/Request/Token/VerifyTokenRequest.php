<?php

namespace LeDevoir\PianoIdApiSDK\Request\Token;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\BaseRequest;
use LeDevoir\PianoIdApiSDK\Response\ResponseContract;
use LeDevoir\PianoIdApiSDK\Response\Token\VerifyTokenResponse;

class VerifyTokenRequest extends BaseRequest
{
    /** @var string  */
    private $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    /**
     * @param Response $response
     * @return ResponseContract
     */
    public function toResponse(Response $response): ResponseContract
    {
        return new VerifyTokenResponse($response);
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
}