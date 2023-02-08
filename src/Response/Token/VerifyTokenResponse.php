<?php

namespace LeDevoir\PianoIdApiSDK\Response\Token;

use LeDevoir\PianoIdApiSDK\Response\PianoIdResponse;

final class VerifyTokenResponse extends PianoIdResponse
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


