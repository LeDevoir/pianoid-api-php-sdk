<?php

namespace LeDevoir\PianoIdApiSDK\Response\Token;

use LeDevoir\PianoIdApiSDK\Response\BaseResponse;

class VerifyTokenResponse extends BaseResponse
{
    /** @var string */
    public $accessToken;

    /** @var string */
    public $tokenType;

    /** @var int */
    public $expiresIn;

    /**
     * @return string
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getTokenType(): string
    {
        return $this->tokenType;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }
}


