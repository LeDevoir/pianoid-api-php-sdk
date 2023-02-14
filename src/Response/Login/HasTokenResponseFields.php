<?php

namespace LeDevoir\PianoIdApiSDK\Response\Login;

trait HasTokenResponseFields
{
    public string $accessToken;
    public string $tokenType;
    public string $refreshToken;
    public int $expiresIn;

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