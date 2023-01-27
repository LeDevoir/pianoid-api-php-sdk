<?php

namespace LeDevoir\PianoIdApiSDK\Response;

final class LoginResponse extends BaseResponse
{
    /** @var string */
    public $accessToken;

    /** @var string */
    public $tokenType;

    /** @var string */
    public $refreshToken;

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
     * @return string
     */
    public function getRefreshToken(): string
    {
        return $this->refreshToken;
    }

    /**
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }
}