<?php

namespace LeDevoir\PianoIdApiSDK\Request\Login;

use GuzzleHttp\Psr7\Response;
use LeDevoir\PianoIdApiSDK\Request\PianoIdRequest;
use LeDevoir\PianoIdApiSDK\Response\Login\GenerateTokenResponse;
use LeDevoir\PianoIdApiSDK\Response\PianoIdResponse;

class GenerateTokenRequest extends PianoIdRequest
{
    private string $pianoUid;

    public function __construct(string $uid)
    {
        $this->pianoUid = $uid;
    }

    /**
     * @inheritDoc
     */
    public function toPianoIdResponse(Response $response): PianoIdResponse
    {
        return new GenerateTokenResponse($response);
    }

    /**
     * @inheritDoc
     */
    public function uri(): string
    {
        return sprintf('%s/token', self::BASE_URL);
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
            'uid' => $this->pianoUid
        ];
    }
}