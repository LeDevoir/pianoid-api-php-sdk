<?php

namespace LeDevoir\PianoIdApiSDK\Response\Token;

use LeDevoir\PianoIdApiSDK\Response\SuccessResponse;

final class VerifyTokenResponse extends SuccessResponse
{
    public string $accessToken;
    public string $tokenType;
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
     * @return int
     */
    public function getExpiresIn(): int
    {
        return $this->expiresIn;
    }
}


